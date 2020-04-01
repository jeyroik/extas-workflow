<?php

use PHPUnit\Framework\TestCase;
use extas\components\workflows\transitions\WorkflowTransition;
use extas\components\workflows\states\WorkflowState;
use extas\interfaces\workflows\states\IWorkflowStateRepository;
use extas\components\workflows\states\WorkflowStateRepository;
use extas\components\SystemContainer;

/**
 * Class WorkflowEntityTest
 *
 * @author jeyroik@gmail.com
 */
class WorkflowTransitionTest extends TestCase
{
    /**
     * @var IRepository|null
     */
    protected ?IRepository $stateRepo = null;

    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();

        $this->stateRepo = new WorkflowStateRepository();

        SystemContainer::addItem(
            IWorkflowStateRepository::class,
            WorkflowStateRepository::class
        );
    }

    public function tearDown(): void
    {
        $this->stateRepo->delete([WorkflowState::FIELD__NAME => 'test']);
    }

    public function testBaseMethods()
    {
        $state = new WorkflowState([
            WorkflowState::FIELD__NAME => 'test'
        ]);

        $transition = new WorkflowTransition();

        $transition->setStateFrom('test2');
        $this->assertEquals('test2', $transition->getStateFromName());

        $transition->setStateTo('test2');
        $this->assertEquals('test2', $transition->getStateToName());

        $this->stateRepo->create($state);

        $transition->setStateFrom($state)->setStateTo($state);

        $state = $transition->getStateFrom();
        $this->assertEquals('test', $state->getName());

        $state = $transition->getStateTo();
        $this->assertEquals('test', $state->getName());
    }
}
