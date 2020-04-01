<?php

use PHPUnit\Framework\TestCase;
use extas\components\workflows\entities\WorkflowEntity;

/**
 * Class WorkflowEntityTest
 *
 * @author jeyroik@gmail.com
 */
class WorkflowEntityTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testBaseMethods()
    {
        $entity = new WorkflowEntity();
        $entity->setStateName('test');
        $this->assertEquals('test', $entity->getStateName());

        $entity->setTemplateName('test');
        $this->assertEquals('test', $entity->getTemplateName());
    }
}
