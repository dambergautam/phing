<?php

namespace Test\Helpers;

use Corgi\File\Helpers\OsHelper;
use Test\BaseTestCase\GenericTestCase;

class OsHelperTest extends GenericTestCase
{
    /**
     * @covers Corgi\File\Helpers\OsHelper::isWindows
     */
    public function testIsWindows()
    {
        $this->assertBool(OsHelper::isWindows());
    }
}
