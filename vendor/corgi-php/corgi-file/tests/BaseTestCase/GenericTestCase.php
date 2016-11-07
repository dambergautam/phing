<?php

namespace Test\BaseTestCase;

abstract class GenericTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param mixed $condition
     */
    protected function assertBool($condition)
    {
        $this->assertTrue(is_bool($condition));
    }
}