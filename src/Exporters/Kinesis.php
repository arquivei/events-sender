<?php

namespace Arquivei\Events\Sender\Exporters;

use Aws\Kinesis\KinesisClient;
use Aws\Credentials\Credentials;
use Arquivei\Events\Sender\Message;
use Arquivei\Events\Sender\Interfaces\ExporterInterface;
use Arquivei\Events\Sender\Exceptions\FailedSenderToKinesisException;

class Kinesis implements ExporterInterface
{
    private $client;

    public function __construct(array $clientConfig)
    {
        $credentials = new Credentials(
            $clientConfig['credentials']['key'],
            $clientConfig['credentials']['secret']
        );
        $this->client = new KinesisClient([
            'credentials' => $credentials,
            'region' => $clientConfig['region'],
            'version' => $clientConfig['version'],
        ]);
    }

    public function push(Message $message, string $stream, ?string $key): void
    {
        try {
            $this->client->putRecord([
                "StreamName" => $stream,
                "Data" => $message->toJson(),
                "PartitionKey" => $key ? $key : $message->getId()
            ]);
        } catch (\Exception $exception) {
            throw new FailedSenderToKinesisException(
                'Failed to push message to Kinesis: ' . $exception->getMessage(),
                $exception
            );
        }
    }
}
