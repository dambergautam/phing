<?php

namespace Test\ContentManagers;

use Test\BaseTestCase\ContentManagerTestCase;

class FileContentsTest extends ContentManagerTestCase
{
    /**
     * Set Up
     */
    public function setUp()
    {
        $this->testFilePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR .
            'corgi_file' . DIRECTORY_SEPARATOR .
            'test.txt';

        parent::setUp();
    }

    /**
     * @covers Corgi\File\ContentManagers\FileContents::write
     */
    public function testWrite()
    {
        $this->file->contents()->write($this->testFileContents);
        $this->assertEquals($this->testFileContents, file_get_contents($this->file));
    }

    /**
     * @covers Corgi\File\ContentManagers\FileContents::dump
     * @depends testWrite
     */
    public function testDump()
    {
        $this->file->contents()->write($this->testFileContents);
        ob_start();
        $this->file->contents()->dump();
        $dumpedData = ob_get_clean();
        $this->assertEquals($this->testFileContents, $dumpedData);
    }

    /**
     * @covers Corgi\File\ContentManagers\FileContents::getFile
     * @depends testWrite
     */
    public function testGetFile()
    {
        $this->assertEquals($this->file, $this->file->contents()->getFile());
    }

    /**
     * @covers Corgi\File\ContentManagers\FileContents::load
     * @depends testWrite
     */
    public function testLoad()
    {
        $this->file->contents()->write('<?php return array("test" => "test");');
        $this->assertEquals(array('test' => 'test'), $this->file->contents()->load());
    }

    /**
     * @covers Corgi\File\ContentManagers\FileContents::toString
     * @depends testWrite
     */
    public function testToString()
    {
        $this->file->contents()->write($this->testFileContents);
        $this->assertEquals($this->testFileContents, $this->file->contents()->toString());
    }

    /**
     * @covers Corgi\File\ContentManagers\FileContents::__toString
     * @depends testWrite
     */
    public function test__toString()
    {
        $this->file->contents()->write($this->testFileContents);
        $this->assertEquals($this->testFileContents, $this->file->contents());
    }
}
