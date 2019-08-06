<?php

namespace Arquivei\Events\Sender\Tests;

use Arquivei\Events\Sender\Schemas\BaseSchema;
use PHPUnit\Framework\TestCase;

class BaseSchemaTest extends TestCase
{
    public function testInstanceOf()
    {
        $message = $this->createMock(BaseSchema::class);
        $this->assertInstanceOf(BaseSchema::class, $message);
    }

    public function testMethods()
    {
        $schema = $this->createMock(BaseSchema::class);
        $this->assertTrue(method_exists($schema, 'getId'));
        $this->assertTrue(method_exists($schema, 'getData'));
        $this->assertTrue(method_exists($schema, 'getSource'));
        $this->assertTrue(method_exists($schema, 'getType'));
        $this->assertTrue(method_exists($schema, 'getCreatedAt'));
        $this->assertTrue(method_exists($schema, 'getDataVersion'));
        $this->assertTrue(method_exists($schema, 'getParser'));
    }
}