<?php

namespace Test;

use Corgi\File\File;
use Corgi\File\Helpers\FileSystemHelper;
use Test\BaseTestCase\FileSystemNodeTestCase;

class FileTestTestCase extends FileSystemNodeTestCase
{
    /**
     * @covers Corgi\File\File::touch
     */
    public function testTouch()
    {
        $file = new File($this->fullTestFilePath);
        $this->assertTrue(!FileSystemHelper::doesExist($this->fullTestFilePath));
        $this->assertInstanceOf(get_class($file), $file->touch());
        $this->assertTrue(FileSystemHelper::doesExist($this->fullTestFilePath));
    }

    /**
     * @covers Corgi\File\File::getNodeType
     * @depends testTouch
     */
    public function testGetNodeType()
    {
        $file = new File($this->fullTestFilePath);
        $file->touch();
        $this->assertEquals($file->getNodeType(), $file->getNodeType());
    }

    /**
     * @covers Corgi\File\File::copy
     * @depends testTouch
     */
    public function testCopy()
    {
        $file = new File($this->fullTestFilePath);
        $file->touch();

        $copyPath = $this->getCopyPath($file);

        $this->assertInstanceOf(get_class($file), $file->copy($copyPath));
        $this->assertTrue(FileSystemHelper::isReadableFile($copyPath));
    }

    /**
     * @covers Corgi\File\File::delete
     * @depends testTouch
     */
    public function testDelete()
    {
        $file = new File($this->fullTestFilePath);
        $file->touch();
        $this->assertBool($file->delete());
    }

    /**
     * @covers Corgi\File\File::contents
     * @depends testTouch
     */
    public function testGetContents()
    {
        $file = new File($this->fullTestFilePath);
        $this->assertInstanceOf('\\Corgi\\File\\ContentManagers\\FileContents', $file->contents());
    }
}
