<?php
namespace tests\transitions;

use extas\components\workflows\transitions\dispatchers\TransitionDispatcher;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcherRepository;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherRepository;
use PHPUnit\Framework\TestCase;
use extas\components\workflows\transitions\Transition;
use extas\components\workflows\states\State;
use extas\interfaces\workflows\states\IStateRepository;
use extas\components\workflows\states\StateRepository;
use extas\components\SystemContainer;
use extas\interfaces\repositories\IRepository;

/**
 * Class WorkflowTransitionTest
 *
 * @author jeyroik@gmail.com
 */
class TransitionTest extends TestCase
{
    /**
     * @var IRepository|null
     */
    protected ?IRepository $stateRepo = null;

    /**
     * @var IRepository|null
     */
    protected ?IRepository $dispatcherRepo = null;

    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();

        $this->stateRepo = new StateRepository();
        $this->dispatcherRepo = new TransitionDispatcherRepository();

        SystemContainer::addItem(
            IStateRepository::class,
            StateRepository::class
        );

        SystemContainer::addItem(
            ITransitionDispatcherRepository::class,
            TransitionDispatcherRepository::class
        );
    }

    public function tearDown(): void
    {
        $this->stateRepo->delete([State::FIELD__NAME => 'test']);
    }

    public function testBaseMethods()
    {
        $state = new State([
            State::FIELD__NAME => 'test'
        ]);

        $transition = new Transition();

        $transition->setStateFromName('test2');
        $this->assertEquals('test2', $transition->getStateFromName());

        $transition->setStateToName('test2');
        $this->assertEquals('test2', $transition->getStateToName());

        $this->stateRepo->create($state);

        $transition->setStateFromName($state)->setStateToName($state);

        $state = $transition->getStateFrom();
        $this->assertEquals('test', $state->getName());

        $state = $transition->getStateTo();
        $this->assertEquals('test', $state->getName());
    }

    public function testDispatchers()
    {
        $transition = new Transition([
            Transition::FIELD__CONDITIONS_NAMES => ['test_condition'],
            Transition::FIELD__VALIDATORS_NAMES => ['test_validator'],
            Transition::FIELD__TRIGGERS_NAMES => ['test_trigger']
        ]);

        $this->dispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test_condition',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__CONDITION
        ]));
        $this->dispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test_validator',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__VALIDATOR
        ]));
        $this->dispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test_trigger',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__TRIGGER
        ]));

        $this->assertEquals(['test_condition'], $transition->getConditionsNames());
        $this->assertEquals(['test_validator'], $transition->getValidatorsNames());
        $this->assertEquals(['test_trigger'], $transition->getTriggersNames());

        $transition->removeConditionName('test_condition');
        $transition->removeValidatorName('test_validator');
        $transition->removeTriggerName('test_trigger');

        $this->assertEquals([], $transition->getConditionsNames());
        $this->assertEquals([], $transition->getValidatorsNames());
        $this->assertEquals([], $transition->getTriggersNames());

        $transition->addConditionName('test_condition');
        $transition->addValidatorName('test_validator');
        $transition->addTriggerName('test_trigger');

        $conditions = $transition->getConditions();
        $condition = array_shift($conditions);
        $this->assertTrue($condition instanceof ITransitionDispatcher);

        $validators = $transition->getValidators();
        $validator = array_shift($validators);
        $this->assertTrue($validator instanceof ITransitionDispatcher);

        $triggers = $transition->getTriggers();
        $trigger = array_shift($triggers);
        $this->assertTrue($trigger instanceof ITransitionDispatcher);
    }

    public function testMissedCondition()
    {
        $transition = new Transition();
        $this->expectExceptionMessage('');
        $this->expectExceptionMessage('Transition dispatcher "test" missed');
    }

    public function testMissedValidator()
    {
        $transition = new Transition();
        $this->expectExceptionMessage('Transition dispatcher "test" missed');
        $transition->removeValidatorName('test');
    }

    public function testMissedTrigger()
    {
        $transition = new Transition();
        $this->expectExceptionMessage('Transition dispatcher "test" missed');
        $transition->removeTriggerName('test');
    }
}
