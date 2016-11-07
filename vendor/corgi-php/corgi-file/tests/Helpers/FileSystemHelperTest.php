<?php

namespace Test\Helpers;

use Corgi\File\Helpers\FileSystemHelper;
use Test\BaseTestCase\GenericTestCase;

class FileSystemHelperTest extends GenericTestCase
{
    /**
     * @covers Corgi\File\Helpers\FileSystemHelper::doesExist
     */
    public function testDoesExist()
    {
        $this->assertBool(FileSystemHelper::doesExist());
    }

    /**
     * @covers Corgi\File\Helpers\FileSystemHelper::isDirectory
     */
    public function testIsDirectory()
    {
        $this->assertBool(FileSystemHelper::isDirectory());
    }

    /**
     * @covers Corgi\File\Helpers\FileSystemHelper::isFile
     */
    public function testIsFile()
    {
        $this->assertBool(FileSystemHelper::isFile());
    }

    /**
     * @covers Corgi\File\Helpers\FileSystemHelper::isLink
     */
    public function testIsLink()
    {
        $this->assertBool(FileSystemHelper::isLink());
    }

    /**
     * @covers Corgi\File\Helpers\FileSystemHelper::isReadable
     */
    public function testIsReadable()
    {
        $this->assertBool(FileSystemHelper::isReadable());
    }

    /**
     * @covers Corgi\File\Helpers\FileSystemHelper::isReadableDirectory
     */
    public function testIsReadableDirectory()
    {
        $this->assertBool(FileSystemHelper::isReadableDirectory());
    }

    /**
     * @covers Corgi\File\Helpers\FileSystemHelper::isReadableFile
     */
    public function testIsReadableFile()
    {
        $this->assertBool(FileSystemHelper::isReadableFile());
    }

    /**
     * @covers Corgi\File\Helpers\FileSystemHelper::isWritable
     */
    public function testIsWritable()
    {
        $this->assertBool(FileSystemHelper::isWritable());
    }

    /**
     * @covers Corgi\File\Helpers\FileSystemHelper::isWritableDirectory
     */
    public function testIsWritableDirectory()
    {
        $this->assertBool(FileSystemHelper::isWritableDirectory());
    }

    /**
     * @covers Corgi\File\Helpers\FileSystemHelper::isWritableFile
     */
    public function testIsWritableFile()
    {
        $this->assertBool(FileSystemHelper::isWritableFile());
    }

    /**
     * @covers Corgi\File\Helpers\FileSystemHelper::toFullPath
     */
    public function testToFullPath()
    {
        $this->assertInternalType('string', FileSystemHelper::toFullPath('/arbitrary/file/path'));
    }
}
