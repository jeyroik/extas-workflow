<?php

use PHPUnit\Framework\TestSuite;
use extas\components\workflows\entities\WorkflowEntity;

/**
 * Class WorkflowEntityTest
 *
 * @author jeyroik@gmail.com
 */
class WorkflowEntityTest extends TestSuite
{
    public function testBaseMethods()
    {
        $entity = new WorkflowEntity();
        $entity->setStateName('test');
        $this->assertEquals('test', $entity->getStateName());

        $entity->setTemplateName('test');
        $this->assertEquals('test', $entity->getTemplateName());
    }
}
