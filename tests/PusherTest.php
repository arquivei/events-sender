<?php

namespace Arquivei\Events\Sender\Tests;

use Arquivei\Events\Sender\Exceptions\FailedSenderToKafkaException;
use Arquivei\Events\Sender\Exceptions\PusherException;
use Arquivei\Events\Sender\Exporters\ExporterInterface;
use Arquivei\Events\Sender\Factories\LatestSchemaFactory;
use Arquivei\Events\Sender\Pusher;
use PHPUnit\Framework\TestCase;

class PusherTest extends TestCase
{
    private $schema;
    private $exporter;

    protected function setUp(): void
    {
        $latestSchemaFactory = new LatestSchemaFactory();
        $data = ['id' => 'test'];
        $this->schema = $latestSchemaFactory->createFromParameters('source', 'type', 1, $data);
        $this->exporter = $this->createMock(ExporterInterface::class);
    }

    public function testPushEvent(): void
    {
        $this->exporter->expects(self::once())->method('push');

        $pusher = new Pusher($this->exporter);
        $pusher->push($this->schema,'topic');
    }

    public function testExporterThrowException(): void
    {
        $this->exporter->expects(self::once())
            ->method('push')
            ->willThrowException(new FailedSenderToKafkaException());

        $this->expectException(PusherException::class);

        $pusher = new Pusher($this->exporter);
        $pusher->push($this->schema,'topic');
    }
}
