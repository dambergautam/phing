<?php

namespace Test\ContentManagers;

use Corgi\File\Directory;
use Corgi\File\File;
use Corgi\File\Helpers\FileSystemHelper;
use Test\BaseTestCase\ContentManagerTestCase;

class DirectoryContentsTest extends ContentManagerTestCase
{
    /**
     * @var Directory
     */
    private $directory;

    /**
     * Set Up
     */
    public function setUp()
    {
        $testDirPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'corgi_file' . DIRECTORY_SEPARATOR . 'test';
        $this->testFilePath = $testDirPath . DIRECTORY_SEPARATOR . 'test.txt';

        $this->directory = new Directory($testDirPath);
        $this->directory->create(true);

        parent::setUp();
    }

    /**
     * Tear Down
     */
    public function tearDown()
    {
        parent::tearDown();

        if (FileSystemHelper::isDirectory($this->directory)) {
            $this->directory->delete();
        }
    }

    /**
     * @covers Corgi\File\ContentManagers\DirectoryContents::addFile
     */
    public function testAddFile()
    {
        $file = new File($this->directory . '/test2.txt');
        $this->directory->contents()->addFile($file);
        $this->assertTrue(FileSystemHelper::isFile($file));
        $file->delete();
    }

    /**
     * @covers Corgi\File\ContentManagers\DirectoryContents::addSubDirectory
     */
    public function testAddSubDirectory()
    {
        $subDirectory = new Directory($this->directory . '/test/test/');
        $this->directory->contents()->addSubDirectory($subDirectory);
        $this->assertTrue(FileSystemHelper::isDirectory($subDirectory));
        $subDirectory->delete();
    }

    /**
     * @covers Corgi\File\ContentManagers\DirectoryContents::getDirectory
     */
    public function testGetDirectory()
    {
        $this->assertEquals($this->directory, $this->directory->contents()->getDirectory());
    }

    /**
     * @covers Corgi\File\ContentManagers\DirectoryContents::toArray
     */
    public function testToArray()
    {
        $this->assertTrue(is_array($this->directory->contents()->toArray()));
    }

    /**
     * @covers Corgi\File\ContentManagers\DirectoryContents::toString
     */
    public function testToString()
    {
        $this->assertInternalType('string', $this->directory->contents()->toString());
    }

    /**
     * @covers Corgi\File\ContentManagers\DirectoryContents::__toString
     */
    public function test__ToString()
    {
        $this->assertInternalType('string', $this->directory->contents()->__toString());
    }

    /**
     * @covers Corgi\File\ContentManagers\DirectoryContents::find
     */
    public function testFind()
    {
        $this->assertTrue(is_array($this->directory->contents()->find('test.txt')));
    }
}
