<?php

namespace Arquivei\Events\Sender\Tests;

use PHPUnit\Framework\TestCase;
use Arquivei\Events\Sender\Sender;

class SenderTest extends TestCase
{
    public function testInstanceOf()
    {
        $sender = $this->createMock(Sender::class);
        $this->assertInstanceOf(Sender::class, $sender);
    }

    public function testMethods()
    {
        $sender = $this->createMock(Sender::class);
        $this->assertTrue(method_exists($sender, 'push'));
    }
}