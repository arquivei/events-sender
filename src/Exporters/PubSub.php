<?php

namespace Arquivei\Events\Sender\Exporters;

use Google\Cloud\PubSub\PubSubClient;
use Arquivei\Events\Sender\Schemas\BaseSchema;
use Arquivei\Events\Sender\Exceptions\FailedSenderToPubSubException;

class PubSub implements ExporterInterface
{
    private $client;

    public function __construct(
        string $projectId,
        string $credentials
    ) {
        $this->client = new PubSubClient([
            'projectId'   => $projectId,
            'keyFilePath' => $credentials,
        ]);
    }

    public function push(BaseSchema $message, string $stream, ?string $key): void
    {
        try {
            $topic = $this->client->topic($stream);
            $topic->publish([
                'data' => $message->getParser()->parse()->toJson(),
            ]);
        } catch (\Exception $exception) {
            throw new FailedSenderToPubSubException($exception);
        }
    }
}