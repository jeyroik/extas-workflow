<?php

use PHPUnit\Framework\TestCase;
use extas\components\workflows\transitions\results\TransitionResult;

/**
 * Class TransitionResultTest
 *
 * @author jeyroik@gmail.com
 */
class TransitionResultTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testFail()
    {
        $result = new TransitionResult();
        $result->fail(400, ['test' => true]);

        $this->assertFalse($result->isSuccess());
        $this->assertEquals(400,$result->getError()->getCode());
        $this->assertEquals(['test' => true],$result->getError()->getData());
        $this->assertEmpty($result->getError()->getMessage());
    }
}
