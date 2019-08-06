<?php

namespace Arquivei\Events\Sender\Tests;

use Arquivei\Events\Sender\Schemas\LatestSchema;
use PHPUnit\Framework\TestCase;

class LatestSchemaTest extends TestCase
{
    public function testInstanceOf()
    {
        $message = $this->createMock(LatestSchema::class);
        $this->assertInstanceOf(LatestSchema::class, $message);
    }

    public function testMethods()
    {
        $schema = $this->createMock(LatestSchema::class);
        $this->assertTrue(method_exists($schema, 'getParser'));
    }

    public function testParametersLatestSchema()
    {
        $schema = new LatestSchema('source','id', '05-10-1994','type',1, ['data'], 1);
        $this->assertEquals('source', $schema->getSource());
        $this->assertEquals('type', $schema->getType());
        $this->assertEquals(1, $schema->getDataVersion());
        $this->assertEquals(['data'], $schema->getData());
    }
}
