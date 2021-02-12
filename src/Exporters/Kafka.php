<?php

namespace Arquivei\Events\Sender\Exporters;

use Arquivei\Events\Sender\Exceptions\FailedSenderToKafkaException;
use Arquivei\Events\Sender\Schemas\BaseSchema;

class Kafka implements ExporterInterface
{
    private $topic;
    private $stream;
    private $producer;
    private $timeout;

    public function __construct(array $config)
    {
        $this->producer = new \RdKafka\Producer($this->setConf($config));
        $this->timeout = $config['flush_timeout'] ?? 30000;
    }

    public function push(BaseSchema $schema, string $stream, ?string $key): void
    {
        try {
            $topic = $this->getTopic($stream);
            $topic->produce(RD_KAFKA_PARTITION_UA, 0, $schema->getParser()->toJson(), $key);

            if (method_exists($this->producer, 'flush')) {
                $this->producer->flush($this->timeout);
            }
        } catch (\Exception $exception) {
            throw new FailedSenderToKafkaException(
                'Failed to push message to Kafka: ' . $exception->getMessage(),
                $exception
            );
        }
    }

    private function setConf(array $config): \RdKafka\Conf
    {
        $conf = new \RdKafka\Conf();
        $conf->set('compression.codec', 'gzip');
        $conf->set('metadata.broker.list', $config['kafka_brokers']);
        $conf->set('security.protocol', $config['security_protocol']);
        $conf->set('acks', 'all');
        $conf->set('sasl.mechanisms', $config['sasl_mechanisms']);
        $conf->set('sasl.username', $config['sasl_username']);
        $conf->set('sasl.password', $config['sasl_password']);

        return $conf;
    }

    private function getTopic(string $stream): \RdKafka\ProducerTopic
    {
        if ($this->stream !== $stream || is_null($this->topic)) {
            $this->stream = $stream;
            $this->topic = $this->producer->newTopic($stream);
            return $this->topic;
        }

        return $this->topic;
    }
}
