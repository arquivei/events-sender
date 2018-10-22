<?php

namespace Arquivei\Events\Sender\Tests;

use PHPUnit\Framework\TestCase;
use Arquivei\Events\Sender\Sender;
use Arquivei\Events\Sender\Message;
use Arquivei\Events\Sender\Exceptions\EmptyExportersException;

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
        $this->assertTrue(method_exists($sender, 'buildExporter'));
        $this->assertTrue(method_exists($sender, 'validateExporter'));
    }

    public function testEmptyExporters()
    {
        $this->expectException(EmptyExportersException::class);

        $messageMock = $this->createMock(Message::class);

        $sender = new Sender([]);
        $sender->push($messageMock, '');
    }
}