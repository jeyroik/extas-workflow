<?php
namespace tests\workflows;

use Dotenv\Dotenv;
use extas\components\Item;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\THasMagicClass;
use extas\components\workflows\entities\Entity;
use extas\components\workflows\entities\EntitySample;
use extas\components\workflows\entities\THasEntitySample;
use extas\components\workflows\schemas\Schema;
use extas\components\workflows\schemas\THasSchema;
use extas\components\workflows\states\State;
use extas\components\workflows\states\StateSample;
use extas\components\workflows\states\THasState;
use extas\components\workflows\transitions\THasTransition;
use extas\components\workflows\transitions\Transition;
use extas\components\workflows\transitions\TransitionSample;
use extas\interfaces\workflows\entities\IHasEntitySample;
use extas\interfaces\workflows\schemas\IHasSchema;
use extas\interfaces\workflows\states\IHasState;
use extas\interfaces\workflows\transitions\IHasTransition;
use PHPUnit\Framework\TestCase;

class TraitsTest extends TestCase
{
    use TSnuffRepositoryDynamic;
    use THasMagicClass;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([
            ['workflowEntitiesSamples', 'name', EntitySample::class],
            ['workflowStates', 'name', State::class],
            ['workflowTransitions', 'name', Transition::class],
            ['workflowSchemas', 'name', Schema::class],
        ]);
    }

    public function tearDown(): void
    {
        $this->deleteSnuffDynamicRepositories();
    }

    public function testHasState()
    {
        $item = new class extends Item implements IHasState {
            use THasState;
            protected function getSubjectForExtension(): string
            {
                return '';
            }
        };

        $this->getMagicClass('workflowStates')->create(new State([
            State::FIELD__NAME => 'test'
        ]));
        $item->setStateName('test');

        $this->assertEquals('test', $item->getStateName());
        $this->assertEquals('test', $item->getState()->getName());
    }

    public function testHasTransitions()
    {
        $item = new class extends Item implements IHasTransition {
            use THasTransition;
            protected function getSubjectForExtension(): string
            {
                return '';
            }
        };

        $this->getMagicClass('workflowTransitions')->create(new Transition([
            Transition::FIELD__NAME => 'test'
        ]));
        $item->setTransitionName('test');

        $this->assertEquals('test', $item->getTransitionName());
        $this->assertEquals('test', $item->getTransition()->getName());
    }

    public function testHasEntitySample()
    {
        $item = new class extends Item implements IHasEntitySample {
            use THasEntitySample;
            protected function getSubjectForExtension(): string
            {
                return '';
            }
        };

        $this->getMagicClass('workflowEntitiesSamples')->create(new EntitySample([
            EntitySample::FIELD__NAME => 'test'
        ]));
        $item->setEntitySampleName('test');

        $this->assertEquals('test', $item->getEntitySampleName());
        $this->assertEquals('test', $item->getEntitySample()->getName());
    }

    public function testHasSchema()
    {
        $item = new class extends Item implements IHasSchema {
            use THasSchema;
            protected function getSubjectForExtension(): string
            {
                return '';
            }
        };

        $this->getMagicClass('workflowSchemas')->create(new Schema([
            Schema::FIELD__NAME => 'test'
        ]));
        $item->setSchemaName('test');

        $this->assertEquals('test', $item->getSchemaName());
        $this->assertEquals('test', $item->getSchema()->getName());
    }
}
