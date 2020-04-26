<?php
namespace tests\entities;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use extas\components\workflows\entities\Entity;

/**
 * Class WorkflowEntityTest
 *
 * @author jeyroik@gmail.com
 */
class EntityTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testBaseMethods()
    {
        $entity = new Entity();
        $entity->setStateName('test');
        $this->assertEquals('test', $entity->getStateName());
    }
}
