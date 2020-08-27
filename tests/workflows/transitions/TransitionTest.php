<?php
namespace tests\transitions;

use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\THasMagicClass;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcherSample;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;

use extas\components\repositories\TSnuffRepository;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcher;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcherRepository;
use extas\components\workflows\transitions\Transition;
use extas\components\workflows\states\State;
use extas\components\workflows\states\StateRepository;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

/**
 * Class WorkflowTransitionTest
 *
 * @author jeyroik@gmail.com
 */
class TransitionTest extends TestCase
{
    use TSnuffRepositoryDynamic;
    use THasMagicClass;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([
            ['workflowStates', 'name', State::class],
            ['workflowTransitionsDispatchers', 'name', TransitionDispatcher::class]
        ]);
    }

    public function tearDown(): void
    {
        $this->deleteSnuffDynamicRepositories();
    }

    public function testBaseMethods()
    {
        $this->getMagicClass('workflowStates')->create(new State([
            State::FIELD__NAME => 'test'
        ]));

        $transition = new Transition();

        $transition->setStateFromName('test');
        $this->assertEquals('test', $transition->getStateFromName());

        $transition->setStateToName('test');
        $this->assertEquals('test', $transition->getStateToName());

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

        $sample = new TransitionDispatcherSample();
        $this->assertEquals($sample->__subject(), 'extas.workflow.transition.dispatcher.sample');

        $this->getMagicClass('workflowTransitionsDispatchers')->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test_condition',
            TransitionDispatcher::FIELD__TITLE => 'test',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__CONDITION
        ]));
        $this->getMagicClass('workflowTransitionsDispatchers')->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test_validator',
            TransitionDispatcher::FIELD__TITLE => 'test',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__VALIDATOR
        ]));
        $this->getMagicClass('workflowTransitionsDispatchers')->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test_trigger',
            TransitionDispatcher::FIELD__TITLE => 'test',
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
        $this->expectExceptionMessage('Missed or unknown transition dispatcher "test"');
        $transition->removeConditionName('test');
    }

    public function testMissedValidator()
    {
        $transition = new Transition();
        $this->expectExceptionMessage('Missed or unknown transition dispatcher "test"');
        $transition->removeValidatorName('test');
    }

    public function testMissedTrigger()
    {
        $transition = new Transition();
        $this->expectExceptionMessage('Missed or unknown transition dispatcher "test"');
        $transition->removeTriggerName('test');
    }
}
