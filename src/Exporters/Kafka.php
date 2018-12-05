<?php

namespace Arquivei\Events\Sender\Exporters;

use Arquivei\Events\Sender\Message;
use Arquivei\Events\Sender\Interfaces\ExporterInterface;
use Arquivei\Events\Sender\Exceptions\FailedSenderToKafkaException;

class Kafka implements ExporterInterface
{
    private $producer;

    public function __construct(array $config)
    {
        $this->producer = new \RdKafka\Producer($this->setConf($config));
    }

    public function push(Message $message, string $stream): void
    {
        try {
            $this->producer->setLogLevel(LOG_DEBUG);
            $topic = $this->producer->newTopic($stream);
            $topic->produce(RD_KAFKA_PARTITION_UA, 0, $message->toJson());
        } catch (\Exception $exception) {
            throw new FailedSenderToKafkaException(
                'Failed to push message to Kafka: ' . $exception->getMessage(),
                $exception
            );
        }
    }

    private function setConf(array $config): \RdKafka\Conf
    {
        $topicConf = new \RdKafka\TopicConf();
        $topicConf->set('auto.offset.reset', 'largest');

        $conf = new \RdKafka\Conf();
        $conf->setDefaultTopicConf($topicConf);
        $conf->set('group.id', $config['group_id']);
        $conf->set('metadata.broker.list', $config['kafka_brokers']);
        $conf->set('enable.auto.commit', "false");
        $conf->set('security.protocol', $config['security_protocol']);
        $conf->set('sasl.mechanisms', $config['sasl_mechanisms']);
        $conf->set('sasl.username', $config['sasl_username']);
        $conf->set('sasl.password', $config['sasl_password']);

        return $conf;
    }
}