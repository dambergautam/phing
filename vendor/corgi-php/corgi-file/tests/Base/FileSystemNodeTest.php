<?php

namespace Test\Base;

use Corgi\File\Directory;
use Corgi\File\File;
use Test\BaseTestCase\FileSystemNodeTestCase;

class FileSystemNodeTestCaseTest extends FileSystemNodeTestCase
{
    /**
     * @covers Corgi\File\Base\FileSystemNode::getPath
     */
    public function testGetPath() {
        $file = new File($this->fullTestFilePath);
        $file->touch();
        $this->assertInternalType('string', $file->getPath());
        $file->delete();

        $directory = new Directory($this->fullTestFilePath);
        $directory->create();
        $this->assertInternalType('string', $directory->getPath());
        $directory->delete();
    }

    /**
     * @covers Corgi\File\Base\FileSystemNode::rename
     */
    public function testRename()
    {
        $file = new File($this->fullTestFilePath);
        $copyPath = $this->getCopyPath($file);
        $file->touch();
        $file->rename($copyPath);
        $this->assertEquals($copyPath, $file->getPath());
        $file->delete();

        $directory = new Directory($this->fullTestFilePath);
        $copyPath = $this->getCopyPath($file);
        $directory->create();
        $directory->rename($copyPath);
        $this->assertEquals($copyPath, $directory->getPath());
        $directory->delete();
    }

    /**
     * @covers Corgi\File\Base\FileSystemNode::__toString
     */
    public function testToString()
    {
        $file = new File($this->fullTestFilePath);
        $this->assertEquals('string', gettype($file->__toString()));

        $directory = new Directory($this->fullTestFilePath);
        $this->assertEquals('string', gettype($directory->__toString()));
    }
}
