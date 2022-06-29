<?php

namespace Arquivei\Events\Sender\Tests\Exporters;

use PHPUnit\Framework\TestCase;
use Arquivei\Events\Sender\Exporters\Kinesis;

class KinesisTest extends TestCase
{
    public function testInstanceOf()
    {
        $kinesis = $this->createMock(Kinesis::class);
        $this->assertInstanceOf(Kinesis::class, $kinesis);
    }

    public function testMethods()
    {
        $kinesis = $this->createMock(Kinesis::class);
        $this->assertTrue(method_exists($kinesis, 'push'));
    }
}
