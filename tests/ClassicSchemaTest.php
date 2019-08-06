<?php

namespace Arquivei\Events\Sender\Tests;

use Arquivei\Events\Sender\Schemas\ClassicSchema;
use PHPUnit\Framework\TestCase;

class ClassicSchemaTest extends TestCase
{
    public function testInstanceOf()
    {
        $message = $this->createMock(ClassicSchema::class);
        $this->assertInstanceOf(ClassicSchema::class, $message);
    }

    public function testMethods()
    {
        $schema = $this->createMock(ClassicSchema::class);
        $this->assertTrue(method_exists($schema, 'getParser'));
    }

    public function testParametersClassicSchema()
    {
        $schema = new ClassicSchema('source','id', '05-10-1994','type',true, 1, ['data'], 3);
        $this->assertEquals('source', $schema->getSource());
        $this->assertEquals('type', $schema->getType());
        $this->assertEquals(1, $schema->getDataVersion());
        $this->assertEquals(['data'], $schema->getData());
        $this->assertEquals(true, $schema->isTracking());

        $this->assertTrue(method_exists($schema, 'isTracking'));
        $this->assertTrue(method_exists($schema, 'getParser'));
    }
}
