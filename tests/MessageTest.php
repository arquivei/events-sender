<?php

namespace Arquivei\Events\Sender\Tests;

use PHPUnit\Framework\TestCase;
use Arquivei\Events\Sender\Message;

class MessageTest extends TestCase
{
    public function testInstanceOf()
    {
        $message = $this->createMock(Message::class);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testMethods()
    {
        $message = $this->createMock(Message::class);
        $this->assertTrue(method_exists($message, 'getId'));
        $this->assertTrue(method_exists($message, 'getData'));
        $this->assertTrue(method_exists($message, 'getSource'));
        $this->assertTrue(method_exists($message, 'getDataType'));
        $this->assertTrue(method_exists($message, 'getCreatedAt'));
        $this->assertTrue(method_exists($message, 'isTracking'));
        $this->assertTrue(method_exists($message, 'getDataVersion'));
        $this->assertTrue(method_exists($message, 'toArray'));
        $this->assertTrue(method_exists($message, 'toJson'));
    }

    public function testParameters()
    {
        $message = new Message('source', 'dataType', 1, ['data'], true);
        $this->assertEquals('source', $message->getSource());
        $this->assertEquals('dataType', $message->getDataType());
        $this->assertEquals(1, $message->getDataVersion());
        $this->assertEquals(['data'], $message->getData());
        $this->assertEquals(true, $message->isTracking());
    }
}