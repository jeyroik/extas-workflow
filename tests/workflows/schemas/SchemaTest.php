<?php
namespace tests\schemas;

use extas\components\extensions\ExtensionRepository;
use extas\components\repositories\TSnuffRepository;
use extas\components\plugins\Plugin;
use extas\components\plugins\PluginRepository;
use extas\components\plugins\repositories\PluginFieldSampleName;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\THasMagicClass;
use extas\components\workflows\entities\Entity;
use extas\components\workflows\entities\EntityRepository;
use extas\components\workflows\entities\EntitySample;
use extas\components\workflows\entities\EntitySampleRepository;
use extas\components\workflows\states\State;
use extas\components\workflows\states\StateRepository;
use extas\components\workflows\states\StateSample;
use extas\components\workflows\states\StateSampleRepository;
use extas\components\workflows\transitions\Transition;
use extas\components\workflows\transitions\TransitionSample;
use extas\components\workflows\transitions\TransitionSampleRepository;
use extas\components\workflows\schemas\Schema;
use extas\components\workflows\transitions\TransitionRepository;

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

        $state = $schema->addState('test');
        $this->assertTrue($schema->hasState($state->getName()));
        $this->assertEquals([$state->getName()], $schema->getStatesNames());
        $this->assertEquals('Test', $schema->getState($state->getName())->getTitle());

        $states = $schema->addStates(['test']);
        $this->assertNotEmpty($states, 'State is not created');
        $test2 = array_shift($states);
        $schema->removeState($test2->getName());
        $this->assertFalse($schema->hasState($test2->getName()));
        $schema->removeState($test2->getName());
    }

    public function testTransitions()
    {
        $schema = new Schema([Schema::FIELD__NAME => 'test']);
        $this->assertFalse($schema->hasTransition('test'));

        $this->getMagicClass('workflowTransitionsSamples')->create(new TransitionSample([
            TransitionSample::FIELD__NAME => 'test',
            TransitionSample::FIELD__TITLE => 'Test'
        ]));
        $this->createWithSnuffRepo('pluginRepository', new Plugin([
            Plugin::FIELD__CLASS => PluginFieldSampleName::class,
            Plugin::FIELD__STAGE => 'extas.workflow_transitions.create.before'
        ]));

        $transition = $schema->addTransition('test');
        $this->assertTrue($schema->hasTransition($transition->getName()));
        $this->assertEquals([$transition->getName()], $schema->getTransitionsNames());

        $transitions = $schema->addTransitions(['test']);
        $test2 = array_shift($transitions);
        $schema->removeTransition($test2->getName());
        $this->assertFalse($schema->hasTransition($test2->getName()));
        $schema->removeTransition($test2->getName());
    }

    public function testEntity()
    {
        $schema = new Schema([Schema::FIELD__NAME => 'test']);
        $this->assertEmpty($schema->getEntityName(), 'Schema has entity: ' . $schema->getEntityName());

        $this->getMagicClass('workflowEntitiesSamples')->create(new EntitySample([
            EntitySample::FIELD__NAME => 'test',
            EntitySample::FIELD__TITLE => 'Test'
        ]));
        $this->getMagicClass('workflowEntitiesSamples')->create(new EntitySample([
            EntitySample::FIELD__NAME => 'test2',
            EntitySample::FIELD__TITLE => 'Test'
        ]));
        $entity = $schema->setEntity('test');
        $this->assertEquals('test', $entity->getSampleName());

        $schema->setEntity('test2');
        $this->assertCount(1, $this->getMagicClass('workflowEntities')->all([]));

        $this->expectExceptionMessage('Missed or unknown entity sample "unknown"');
        $schema->setEntity('unknown');
    }
}
