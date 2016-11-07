<?php

namespace Test\BaseTestCase;

abstract class FileSystemNodeTestCase extends GenericTestCase
{
    const TEST_FILE_EXTENSION = '.txt';
    const COPY_EXTENSION = '.bak';

    protected $fullTestFilePath;

    protected $testFilePath;

    /**
     * Setup
     */
    public function setUp()
    {
        $this->testFilePath = str_replace('-', DIRECTORY_SEPARATOR, '-corgi_file-temp-test.txt');
        $this->fullTestFilePath = sys_get_temp_dir() . $this->testFilePath;
    }

    /**
     * Cleanup
     */
    public function tearDown()
    {
        $filesToCleanUp = array(
            $this->fullTestFilePath,
            $this->getCopyPath($this->fullTestFilePath)
        );

        foreach($filesToCleanUp as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    /**
     * Helper function for copying and moving files
     * @param string $filePath
     * @return string
     */
    protected function getCopyPath($filePath)
    {
        $newBaseName = basename($this->testFilePath, self::TEST_FILE_EXTENSION) . self::COPY_EXTENSION;
        return dirname($filePath) . DIRECTORY_SEPARATOR . $newBaseName;
    }
}
