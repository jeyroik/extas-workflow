<?php

use PHPUnit\Framework\TestCase;
use extas\components\workflows\transitions\errors\TransitionError;

/**
 * Class TransitionErrorTest
 *
 * @author jeyroik@gmail.com
 */
class TransitionErrorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testBaseMethods()
    {
        $error = new TransitionError();
        $error->setMessage('test');
        $error->setData(['test']);
        $error->setCode(400);

        $this->assertEquals('test', $error->getMessage());
        $this->assertEquals(['test'], $error->getData());
        $this->assertEquals(400, $error->getCode());
    }
}
