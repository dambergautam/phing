<?php

namespace Test;

use Corgi\File\Constants\NodeType;
use Corgi\File\Directory;
use Corgi\File\File;
use Test\BaseTestCase\FileSystemNodeTestCase;

class DirectoryTest extends FileSystemNodeTestCase
{
    private $baseDirPath;
    private $copyPath;
    private $fullDirectoryPath;

    /**
     * Set up
     */
    public function setUp()
    {
        parent::setUp();
        $testDir = str_replace('-', DIRECTORY_SEPARATOR, '1-2-3');
        $this->baseDirPath = dirname($this->fullTestFilePath);
        $this->fullDirectoryPath = $this->baseDirPath . DIRECTORY_SEPARATOR . $testDir;
        $this->copyPath = $this->baseDirPath . '1' . DIRECTORY_SEPARATOR . $testDir;
    }

    /**
     * Tear down
     */
    public function tearDown()
    {
        parent::tearDown();

        $dirsToRemove = array(
            $this->baseDirPath,
            $this->copyPath
        );

        foreach($dirsToRemove as $directory) {
            if (file_exists($directory)) {
                $this->removeDir($directory);
            }
        }
    }

    /**
     * @covers Corgi\File\Directory::create
     */
    public function testCreate()
    {
        $directory = new Directory($this->fullDirectoryPath);
        $directory->create(true);
        $this->assertTrue(file_exists($directory) && is_dir($directory));
        $this->removeDir($directory);
    }

    /**
     * @covers Corgi\File\Directory::copy
     * @depends testCreate
     */
    public function testCopy()
    {
        $directory = new Directory($this->fullDirectoryPath);
        $directory->create(true);
        $directory->copy($this->copyPath);
        $this->assertEquals($this->copyPath, $directory);
        $this->assertTrue(file_exists($directory) && is_dir($directory));
        $this->removeDir($this->baseDirPath);
        $this->removeDir($this->baseDirPath . '1');
    }

    /**
     * @covers Corgi\File\Directory::delete
     * @depends testCreate
     */
    public function testDelete()
    {
        $directory = new Directory($this->fullDirectoryPath);
        $directory->create(true);
        $this->assertTrue(file_exists($directory) && is_dir($directory));
        $directory->delete();
        $this->assertFalse(is_dir($directory));
        $this->removeDir($this->baseDirPath);
    }

    /**
     * @covers Corgi\File\Directory::contents
     * @depends testCreate
     */
    public function testGetContents()
    {
        $directory = new Directory($this->fullDirectoryPath);
        $this->assertInstanceOf('\\Corgi\\File\\ContentManagers\\DirectoryContents', $directory->contents());
    }

    /**
     * @covers Corgi\File\Directory::getNodeType
     * @depends testCreate
     */
    public function testGetNodeType()
    {
        $directory = new Directory($this->fullDirectoryPath);
        $this->assertEquals(NodeType::DIRECTORY, $directory->getNodeType());
    }

    /**
     * @covers Corgi\File\Directory::iterate
     * @depends testCreate
     */
    public function testIterate()
    {
        $iterations = new \stdClass();
        $iterations->flag = false;

        $closure = function() use ($iterations) {
            $iterations->flag = true;
        };

        $directory = new Directory(dirname($this->fullTestFilePath));
        $file = new File($this->fullTestFilePath);
        $directory->create();
        $file->touch();
        $directory->iterate($closure);
        $file->delete();
        $directory->delete();

        $this->assertTrue($iterations->flag);
    }

    /**
     * @covers Corgi\File\Directory::safeDelete
     * @depends testCreate
     */
    public function testSafeDelete()
    {
        $directory = new Directory($this->baseDirPath);
        $directory->create();
        $this->assertTrue(file_exists($directory) && is_dir($directory));
        $directory->safeDelete();
        $this->assertFalse(is_dir($directory));
    }

    /**
     * Recursively removes a directory
     * @param $dir
     */
    private function removeDir($dir)
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $dir, \FilesystemIterator::SKIP_DOTS
            ),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($iterator as $filename => $fileInfo) {
            if ($fileInfo->isDir()) {
                rmdir($filename);
            } else {
                unlink($filename);
            }
        }

        rmdir($dir);
    }
}
