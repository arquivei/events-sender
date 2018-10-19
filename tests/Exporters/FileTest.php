<?php

namespace Arquivei\Events\Sender\Tests;

use PHPUnit\Framework\TestCase;
use Arquivei\Events\Sender\Exporters\File;

class FileTest extends TestCase
{
    public function testInstanceOf()
    {
        $file = $this->createMock(File::class);
        $this->assertInstanceOf(File::class, $file);
    }

    public function testMethods()
    {
        $file = $this->createMock(File::class);
        $this->assertTrue(method_exists($file, 'push'));
    }
}