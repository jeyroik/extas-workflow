<?php
namespace tests\workflows\transits;

use extas\components\workflows\entities\Entity;
use PHPUnit\Framework\TestCase;
use extas\components\workflows\transits\TransitResult;

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
        $result = new TransitResult();
        $entity = new Entity([
            'test' => 'is ok'
        ]);
        $result->success($entity);

        $this->assertEquals($entity, $result->getEntity());
    }
}
