<?php

namespace Arquivei\Events\Sender\Tests\Exporters;

use PHPUnit\Framework\TestCase;
use Arquivei\Events\Sender\Exporters\Kafka;

class KafkaTest extends TestCase
{
    public function testInstanceOf()
    {
        $kafka = $this->createMock(Kafka::class);
        $this->assertInstanceOf(Kafka::class, $kafka);
    }

    public function testMethods()
    {
        $kafka = $this->createMock(Kafka::class);
        $this->assertTrue(method_exists($kafka, 'push'));
        $this->assertTrue(method_exists($kafka, 'setConf'));
    }
}
