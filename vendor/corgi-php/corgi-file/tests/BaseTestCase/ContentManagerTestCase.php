<?php

namespace Test\BaseTestCase;

use Corgi\File\File;

abstract class ContentManagerTestCase extends GenericTestCase
{
    /**
     * @var File
     */
    protected $file;

    protected $testFilePath;

    protected $testFileContents;

    public function setUp()
    {
        $this->file = new File($this->testFilePath);
        $this->file->touch();
        $this->testFileContents = md5(date('YmdHis'));
    }

    public function tearDown()
    {
        $this->file->delete();
    }
}
