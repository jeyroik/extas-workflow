<?php
namespace tests\schemas;

use Dotenv\Dotenv;
use extas\components\workflows\states\State;
use extas\components\workflows\states\StateRepository;
use extas\interfaces\workflows\states\IState;
use extas\interfaces\workflows\states\IStateRepository;
use extas\interfaces\workflows\transitions\ITransition;
use PHPUnit\Framework\TestCase;
use extas\interfaces\repositories\IRepository;
use extas\components\workflows\schemas\Schema;
use extas\components\SystemContainer;
use extas\components\workflows\transitions\Transition;
use extas\components\workflows\transitions\TransitionRepository;
use extas\interfaces\workflows\transitions\ITransitionRepository;

/**
 * Class WorkflowSchemaTest
 *
 * @author jeyroik@gmail.com
 */
class SchemaTest extends TestCase
{
    /**
     * @var IRepository|null
     */
    protected ?IRepository $stateRepo = null;

    /**
     * @var IRepository|null
     */
    protected ?IRepository $transitionRepo = null;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();

        $this->stateRepo = new StateRepository();
        $this->transitionRepo = new TransitionRepository();

        SystemContainer::addItem(
            IStateRepository::class,
            StateRepository::class
        );

        SystemContainer::addItem(
            ITransitionRepository::class,
            TransitionRepository::class
        );
    }

    public function tearDown(): void
    {
        $this->stateRepo->delete([IState::FIELD__NAME => 'test']);
        $this->transitionRepo->delete([ITransition::FIELD__NAME => 'test']);
    }

    public function testStates()
    {
        $schema = new Schema();
        $this->assertFalse($schema->hasStateName('test'));

        $schema->addStateName('test');
        $this->assertTrue($schema->hasStateName('test'));
        $this->assertEquals(['test'], $schema->getStatesNames());

        $schema->setStatesNames(['test2']);
        $schema->removeStateName('test2');
        $this->assertFalse($schema->hasStateName('test2'));

        $schema->addStateName('test');
        $this->stateRepo->create(new State([
            State::FIELD__NAME => 'test',
            State::FIELD__TITLE => 'Test'
        ]));
        $state = $schema->getState('test');
        $this->assertEquals('Test', $state->getTitle());
        $this->assertEquals([$state], $schema->getStates());

        $this->expectExceptionMessage('State "test2" missed');
        $schema->removeStateName('test2');
    }

    public function testTransitions()
    {
        $schema = new Schema();
        $this->assertFalse($schema->hasTransitionName('test'));

        $schema->addTransitionName('test');
        $this->assertTrue($schema->hasTransitionName('test'));
        $this->assertEquals(['test'], $schema->getTransitionsNames());

        $schema->setTransitionsNames(['test2']);
        $schema->removeTransitionName('test2');
        $this->assertFalse($schema->hasTransitionName('test2'));

        $schema->addTransitionName('test');
        $this->transitionRepo->create(new Transition([
            Transition::FIELD__NAME => 'test',
            Transition::FIELD__TITLE => 'Test'
        ]));
        $transition = $schema->getTransition('test');
        $this->assertEquals('Test', $transition->getTitle());
        $this->assertEquals([$transition], $schema->getTransitions());

        $this->expectExceptionMessage('Transition "test2" missed');
        $schema->removeTransitionName('test2');
    }
}
