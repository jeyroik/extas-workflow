<?php
namespace tests\workflows;

use Dotenv\Dotenv;
use extas\interfaces\workflows\transits\ITransitResult;
use PHPUnit\Framework\TestCase;
use extas\interfaces\repositories\IRepository;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcherRepository;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherRepository;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcher;
use extas\components\SystemContainer;
use extas\components\workflows\transitions\Transition;
use extas\components\workflows\entities\Entity;
use extas\components\workflows\entities\EntityContext;

use extas\components\workflows\Workflow;
use tests\TriggerChangeEntity;

/**
 * Class WorkflowTest
 *
 * @author jeyroik@gmail.com
 */
class WorkflowTest extends TestCase
{
    /**
     * @var IRepository|null
     */
    protected ?IRepository $transitionDispatcherRepo = null;

    protected function setUp(): void
    {
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();

        $this->transitionDispatcherRepo = new TransitionDispatcherRepository();

        SystemContainer::addItem(
            ITransitionDispatcherRepository::class,
            TransitionDispatcherRepository::class
        );
    }

    public function tearDown(): void
    {
        $this->transitionDispatcherRepo->delete([TransitionDispatcher::FIELD__TITLE => 'test']);
    }

    public function testTransit()
    {
        $entity = $this->getEntity();

        $transition = new Transition([]);
        $workflow = new Workflow([Workflow::FIELD__CONTEXT => new EntityContext()]);
        $result = $workflow->transit($entity, $transition);
        $this->assertTrue($result instanceof ITransitResult);
        $this->assertFalse($result->hasErrors());
        $this->assertEquals(
            $entity,
            $result->getEntity()
        );
    }

    public function testConditionFailed()
    {
        $entity = $this->getEntity();

        $transition = new Transition([
            Transition::FIELD__CONDITIONS_NAMES => [
                'test_condition'
            ]
        ]);
        $this->installDispatcher(
            'test_condition',
            'tests\\ConditionFalse',
            TransitionDispatcher::TYPE__CONDITION
        );
        $workflow = new Workflow([Workflow::FIELD__CONTEXT => new EntityContext()]);
        $result = $workflow->transit($entity, $transition);
        $this->assertTrue($result->hasErrors());
    }

    public function testValidatorFailed()
    {
        $entity = $this->getEntity();

        $transition = new Transition([
            Transition::FIELD__VALIDATORS_NAMES => [
                'test_validator'
            ]
        ]);
        $this->installDispatcher(
            'test_validator',
            'tests\\ConditionFalse',
            TransitionDispatcher::TYPE__VALIDATOR
        );
        $workflow = new Workflow([Workflow::FIELD__CONTEXT => new EntityContext()]);
        $result = $workflow->transit($entity, $transition);
        $this->assertTrue($result->hasErrors());
    }

    public function testTrigger()
    {
        $entity = $this->getEntity();

        $transition = new Transition([
            Transition::FIELD__TRIGGERS_NAMES => [
                'test_trigger'
            ]
        ]);
        $this->installDispatcher(
            'test_trigger',
            'tests\\TriggerChangeEntity',
            TransitionDispatcher::TYPE__TRIGGER
        );
        $workflow = new Workflow([Workflow::FIELD__CONTEXT => new EntityContext()]);
        $result = $workflow->transit($entity, $transition);
        $this->assertFalse($result->hasErrors());
        $entityEdited = $result->getEntity();
        $this->assertTrue($entityEdited->has(TriggerChangeEntity::FIELD__TEST));
    }

    protected function installDispatcher(string $name, string $className, string $type)
    {
        $this->transitionDispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => $name,
            TransitionDispatcher::FIELD__TITLE => 'test',
            TransitionDispatcher::FIELD__CLASS => $className,
            TransitionDispatcher::FIELD__TYPE => $type
        ]));
    }

    protected function getEntity()
    {
        return new Entity([
            Entity::FIELD__STATE_NAME => 'from',
            Entity::FIELD__SAMPLE_NAME => 'test'
        ]);
    }
}
