<?php

namespace Arquivei\Events\Sender\Exporters;

use Arquivei\Events\Sender\Schemas\BaseSchema;
use Aws\Kinesis\KinesisClient;
use Aws\Credentials\Credentials;
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

    public function push(BaseSchema $schema, string $stream, ?string $key): void
    {
        try {
            $this->client->putRecord([
                "StreamName" => $stream,
                "Data" => $schema->getParser()->toJson(),
                "PartitionKey" => $key ? $key : $schema->getId()
            ]);
        } catch (\Exception $exception) {
            throw new FailedSenderToKinesisException(
                'Failed to push message to Kinesis: ' . $exception->getMessage(),
                $exception
            );
        }
    }
}
