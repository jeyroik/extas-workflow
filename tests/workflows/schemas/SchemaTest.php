<?php
namespace tests\schemas;

use extas\components\plugins\Plugin;
use extas\components\plugins\repositories\PluginFieldSampleName;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\THasMagicClass;
use extas\components\workflows\entities\Entity;
use extas\components\workflows\entities\EntitySample;
use extas\components\workflows\states\State;
use extas\components\workflows\states\StateSample;
use extas\components\workflows\transitions\Transition;
use extas\components\workflows\transitions\TransitionSample;
use extas\components\workflows\schemas\Schema;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

/**
 * Class WorkflowSchemaTest
 *
 * @author jeyroik@gmail.com
 */
class SchemaTest extends TestCase
{
    use TSnuffRepositoryDynamic;
    use THasMagicClass;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([
            ['workflowEntities', 'name', Entity::class],
            ['workflowEntitiesSamples', 'name', EntitySample::class],
            ['workflowStates', 'name', State::class],
            ['workflowStatesSamples', 'name', StateSample::class],
            ['workflowTransitions', 'name', Transition::class],
            ['workflowTransitionsSamples', 'name', TransitionSample::class],
        ]);
    }

    public function tearDown(): void
    {
        $this->deleteSnuffDynamicRepositories();
    }

    public function testStates()
    {
        $schema = new Schema([Schema::FIELD__NAME => 'test']);
        $this->assertFalse($schema->hasState('test'));

        $this->getMagicClass('workflowStatesSamples')->create(new StateSample([
            StateSample::FIELD__NAME => 'test',
            StateSample::FIELD__TITLE => 'Test'
        ]));
        $this->createWithSnuffRepo('pluginRepository', new Plugin([
            Plugin::FIELD__CLASS => PluginFieldSampleName::class,
            Plugin::FIELD__STAGE => 'extas.workflow_states.create.before'
        ]));

        $this->getMagicClass('workflowStates')->create(new State([
            State::FIELD__NAME => 'test',
            State::FIELD__SCHEMA_NAME => 'test'
        ]));

        $this->assertTrue($schema->hasState('test'));

        $this->assertCount(1, $schema->getStates(), 'Incorrect states count');
        $this->assertEquals(['test'], $schema->getStatesNames());
    }

    public function testTransitions()
    {
        $schema = new Schema([Schema::FIELD__NAME => 'test']);
        $this->assertFalse($schema->hasTransition('test'));

        $this->createWithSnuffRepo('pluginRepository', new Plugin([
            Plugin::FIELD__CLASS => PluginFieldSampleName::class,
            Plugin::FIELD__STAGE => 'extas.workflow_transitions.create.before'
        ]));

        $this->getMagicClass('workflowTransitions')->create(new Transition([
            Transition::FIELD__NAME => 'test',
            Transition::FIELD__SCHEMA_NAME => 'test'
        ]));

        $this->assertTrue($schema->hasTransition('test'));
        $this->assertCount(1, $schema->getTransitions(), 'Incorrect transitions count');
        $this->assertEquals(['test'], $schema->getTransitionsNames());
    }

    public function testEntity()
    {
        $schema = new Schema([Schema::FIELD__NAME => 'test']);
        $this->assertEmpty($schema->getEntityName(), 'Schema has entity: ' . $schema->getEntityName());

        $this->getMagicClass('workflowEntitiesSamples')->create(new EntitySample([
            EntitySample::FIELD__NAME => 'test',
            EntitySample::FIELD__TITLE => 'Test'
        ]));
        $this->getMagicClass('workflowEntities')->create(new EntitySample([
            EntitySample::FIELD__NAME => 'test',
            EntitySample::FIELD__TITLE => 'test'
        ]));
        $schema->setEntityName('test');
        $this->assertEquals('test', $schema->getEntityName());
    }
}
