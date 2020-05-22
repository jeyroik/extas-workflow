<?php
namespace tests\schemas;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use extas\components\extensions\TSnuffExtensions;
use extas\components\plugins\Plugin;
use extas\components\plugins\PluginRepository;
use extas\components\plugins\repositories\PluginFieldSampleName;
use extas\components\workflows\entities\EntityRepository;
use extas\components\workflows\entities\EntitySample;
use extas\components\workflows\entities\EntitySampleRepository;
use extas\components\workflows\states\StateRepository;
use extas\components\workflows\states\StateSample;
use extas\components\workflows\states\StateSampleRepository;
use extas\components\workflows\transitions\TransitionSample;
use extas\components\workflows\transitions\TransitionSampleRepository;
use extas\interfaces\plugins\IPlugin;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\entities\IEntitySample;
use extas\interfaces\workflows\states\IState;
use extas\interfaces\workflows\transitions\ITransition;
use extas\interfaces\repositories\IRepository;
use extas\components\workflows\schemas\Schema;
use extas\components\workflows\transitions\TransitionRepository;

/**
 * Class WorkflowSchemaTest
 *
 * @author jeyroik@gmail.com
 */
class SchemaTest extends TestCase
{
    use TSnuffExtensions;

    protected IRepository $stateRepo;
    protected IRepository $stateSampleRepo;
    protected IRepository $entityRepo;
    protected IRepository $entitySampleRepo;
    protected IRepository $transitionRepo;
    protected IRepository $transitionSampleRepo;
    protected IRepository $pluginRepo;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();

        $this->stateRepo = new StateRepository();
        $this->stateSampleRepo = new StateSampleRepository();
        $this->entityRepo = new EntityRepository();
        $this->entitySampleRepo = new EntitySampleRepository();
        $this->transitionRepo = new TransitionRepository();
        $this->transitionSampleRepo = new TransitionSampleRepository();
        $this->pluginRepo = new PluginRepository();
        $this->addReposForExt([
            'workflowEntityRepository' => EntityRepository::class,
            'workflowEntitySampleRepository' => EntitySampleRepository::class,
            'workflowStateRepository' => StateRepository::class,
            'workflowStateSampleRepository' => StateSampleRepository::class,
            'workflowTransitionRepository' => TransitionRepository::class,
            'workflowTransitionSampleRepository' => TransitionSampleRepository::class
        ]);
        $this->createRepoExt([
            'workflowEntityRepository',
            'workflowEntitySampleRepository',
            'workflowStateRepository',
            'workflowStateSampleRepository',
            'workflowTransitionRepository',
            'workflowTransitionSampleRepository'
        ]);
    }

    public function tearDown(): void
    {
        $this->entityRepo->delete([IEntity::FIELD__SAMPLE_NAME => 'test']);
        $this->entitySampleRepo->delete([IEntitySample::FIELD__TITLE => 'Test']);
        $this->stateRepo->delete([IState::FIELD__SAMPLE_NAME => 'test']);
        $this->stateSampleRepo->delete([IState::FIELD__NAME => 'test']);
        $this->transitionRepo->delete([ITransition::FIELD__SAMPLE_NAME => 'test']);
        $this->transitionSampleRepo->delete([ITransition::FIELD__NAME => 'test']);
        $this->pluginRepo->delete([IPlugin::FIELD__STAGE => [
            'extas.workflow_states.create.before',
            'extas.workflow_transitions.create.before',
        ]]);
    }

    public function testStates()
    {
        $schema = new Schema([Schema::FIELD__NAME => 'test']);
        $this->assertFalse($schema->hasState('test'));

        $this->stateSampleRepo->create(new StateSample([
            StateSample::FIELD__NAME => 'test',
            StateSample::FIELD__TITLE => 'Test'
        ]));
        $this->pluginRepo->create(new Plugin([
            Plugin::FIELD__CLASS => PluginFieldSampleName::class,
            Plugin::FIELD__STAGE => 'extas.workflow_states.create.before'
        ]));

        $state = $schema->addState('test');
        $this->assertTrue($schema->hasState($state->getName()));
        $this->assertEquals([$state->getName()], $schema->getStatesNames());
        $this->assertEquals('Test', $schema->getState($state->getName())->getTitle());

        $states = $schema->addStates(['test']);
        $test2 = array_shift($states);
        $schema->removeState($test2->getName());
        $this->assertFalse($schema->hasState($test2->getName()));

        $this->expectExceptionMessage('State "' . $test2->getName() . '" missed');
        $schema->removeState($test2->getName());
    }

    public function testTransitions()
    {
        $schema = new Schema([Schema::FIELD__NAME => 'test']);
        $this->assertFalse($schema->hasTransition('test'));

        $this->transitionSampleRepo->create(new TransitionSample([
            TransitionSample::FIELD__NAME => 'test',
            TransitionSample::FIELD__TITLE => 'Test'
        ]));
        $this->pluginRepo->create(new Plugin([
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

        $this->expectExceptionMessage('Transition "' . $test2->getName() . '" missed');
        $schema->removeTransition($test2->getName());
    }

    public function testEntity()
    {
        $schema = new Schema([Schema::FIELD__NAME => 'test']);
        $this->assertEmpty($schema->getEntityName());
        $this->entitySampleRepo->create(new EntitySample([
            EntitySample::FIELD__NAME => 'test',
            EntitySample::FIELD__TITLE => 'Test'
        ]));
        $this->entitySampleRepo->create(new EntitySample([
            EntitySample::FIELD__NAME => 'test2',
            EntitySample::FIELD__TITLE => 'Test'
        ]));
        $entity = $schema->setEntity('test');
        $this->assertEquals('test', $entity->getSampleName());

        $schema->setEntity('test2');
        $this->assertCount(1, $this->entityRepo->all([]));

        $this->expectExceptionMessage('Entity sample "unknown" missed');
        $schema->setEntity('unknown');
    }
}
