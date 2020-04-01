<?php

use PHPUnit\Framework\TestCase;
use extas\components\workflows\entities\WorkflowEntityTemplateRepository;
use extas\interfaces\workflows\entities\IWorkflowEntityTemplateRepository;
use extas\interfaces\repositories\IRepository;
use extas\components\workflows\schemas\WorkflowSchema;
use extas\components\workflows\entities\WorkflowEntityTemplate;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcherRepository;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherRepository;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcher;
use extas\components\SystemContainer;
use extas\components\workflows\transitions\WorkflowTransition;
use extas\components\workflows\transitions\WorkflowTransitionRepository;
use extas\interfaces\workflows\transitions\IWorkflowTransitionRepository;

/**
 * Class WorkflowSchemaTest
 *
 * @author jeyroik@gmail.com
 */
class WorkflowSchemaTest extends TestCase
{
    /**
     * @var IRepository|null
     */
    protected ?IRepository $entityTemplateRepo = null;

    /**
     * @var IRepository|null
     */
    protected ?IRepository $transitionDispatcherRepo = null;

    /**
     * @var IRepository|null
     */
protected ?IRepository $transitionRepo = null;

    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();

        $this->entityTemplateRepo = new WorkflowEntityTemplateRepository();
        $this->transitionDispatcherRepo = new TransitionDispatcherRepository();
        $this->transitionRepo = new WorkflowTransitionRepository();

        SystemContainer::addItem(
            ITransitionDispatcherRepository::class,
            TransitionDispatcherRepository::class
        );
        SystemContainer::addItem(
            IWorkflowEntityTemplateRepository::class,
            WorkflowEntityTemplateRepository::class
        );
        SystemContainer::addItem(
            IWorkflowTransitionRepository::class,
            WorkflowTransitionRepository::class
        );
    }

    public function tearDown(): void
    {
        $this->entityTemplateRepo->delete([WorkflowEntityTemplate::FIELD__NAME => 'test']);
        $this->transitionDispatcherRepo->delete([TransitionDispatcher::FIELD__NAME => 'test']);
        $this->transitionRepo->delete([WorkflowTransition::FIELD__NAME => 'test']);
    }

    /**
     * @throws 
     */
    public function testIsApplicableEntityTemplate()
    {
        $schema = new WorkflowSchema();
        $schema->setEntityTemplateName('test');
        $this->assertEquals(true, $schema->isApplicableEntityTemplate('test'));
    }

    /**
     * @throws 
     */
    public function testGetEntityTemplate()
    {
        $this->entityTemplateRepo->create(new WorkflowEntityTemplate([
            WorkflowEntityTemplate::FIELD__NAME => 'test',
            WorkflowEntityTemplate::FIELD__TITLE => 'Test'
        ]));

        $schema = new WorkflowSchema();
        $schema->setEntityTemplate(new WorkflowEntityTemplate([
            WorkflowEntityTemplate::FIELD__NAME => 'test'
        ]));

        $template = $schema->getEntityTemplate();
        $this->assertEquals('Test', $template->getTitle());

        $schema->setEntityTemplateName('test2');
        $this->assertEquals('test2', $schema->getEntityTemplateName());
    }

    /**
     * @throws 
     */
    public function testGetConditions()
    {
        $this->transitionDispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test',
            TransitionDispatcher::FIELD__SCHEMA_NAME => 'test',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__CONDITION
        ]));

        $schema = new WorkflowSchema([
            WorkflowSchema::FIELD__NAME => 'test',
            WorkflowSchema::FIELD__ENTITY_TEMPLATE => 'test'
        ]);

        $conditions = $schema->getConditions();
        $this->assertCount(1, $conditions);
        $firstCondition = array_shift($conditions);
        $this->assertEquals('test', $firstCondition->getName());
    }

    /**
     * @throws 
     */
    public function testGetValidators()
    {
        $this->transitionDispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test',
            TransitionDispatcher::FIELD__SCHEMA_NAME => 'test',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__VALIDATOR
        ]));

        $schema = new WorkflowSchema([
            WorkflowSchema::FIELD__NAME => 'test',
            WorkflowSchema::FIELD__ENTITY_TEMPLATE => 'test'
        ]);

        $dispatchers = $schema->getValidators();
        $this->assertCount(1, $dispatchers);
        $first = array_shift($dispatchers);
        $this->assertEquals('test', $first->getName());
    }

    /**
     * @throws 
     */
    public function testGetConditionsByTransition()
    {
        $this->transitionDispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test',
            TransitionDispatcher::FIELD__SCHEMA_NAME => 'test',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__CONDITION,
            TransitionDispatcher::FIELD__TRANSITION_NAME => 'test'
        ]));

        $schema = new WorkflowSchema([
            WorkflowSchema::FIELD__NAME => 'test',
            WorkflowSchema::FIELD__ENTITY_TEMPLATE => 'test'
        ]);

        $transition = new WorkflowTransition([
            WorkflowTransition::FIELD__NAME => 'test'
        ]);

        $conditions = $schema->getConditionsByTransition($transition);
        $this->assertCount(1, $conditions);
        $firstCondition = array_shift($conditions);
        $this->assertEquals('test', $firstCondition->getName());

        $conditions = $schema->getConditionsByTransition($transition->getName());
        $this->assertCount(1, $conditions);
        $firstCondition = array_shift($conditions);
        $this->assertEquals('test', $firstCondition->getName());
    }

    /**
     * @throws 
     */
    public function testGetValidatorsByTransition()
    {
        $this->transitionDispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test',
            TransitionDispatcher::FIELD__SCHEMA_NAME => 'test',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__VALIDATOR
        ]));

        $schema = new WorkflowSchema([
            WorkflowSchema::FIELD__NAME => 'test',
            WorkflowSchema::FIELD__ENTITY_TEMPLATE => 'test'
        ]);

        $transition = new WorkflowTransition([
            WorkflowTransition::FIELD__NAME => 'test'
        ]);

        $dispatchers = $schema->getValidatorsByTransition($transition);
        $this->assertCount(1, $dispatchers);
        $first = array_shift($dispatchers);
        $this->assertEquals('test', $first->getName());

        $dispatchers = $schema->getValidatorsByTransition($transition->getName());
        $this->assertCount(1, $dispatchers);
        $first = array_shift($dispatchers);
        $this->assertEquals('test', $first->getName());
    }

    /**
     * @throws 
     */
    public function testGetTriggers()
    {
        $this->transitionDispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test',
            TransitionDispatcher::FIELD__SCHEMA_NAME => 'test',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__TRIGGER
        ]));

        $schema = new WorkflowSchema([
            WorkflowSchema::FIELD__NAME => 'test',
            WorkflowSchema::FIELD__ENTITY_TEMPLATE => 'test'
        ]);

        $dispatchers = $schema->getTriggers();
        $this->assertCount(1, $dispatchers);
        $first = array_shift($dispatchers);
        $this->assertEquals('test', $first->getName());
    }

    /**
     * @throws 
     */
    public function testGetTriggersByTransition()
    {
        $this->transitionDispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test',
            TransitionDispatcher::FIELD__SCHEMA_NAME => 'test',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__TRIGGER
        ]));

        $schema = new WorkflowSchema([
            WorkflowSchema::FIELD__NAME => 'test',
            WorkflowSchema::FIELD__ENTITY_TEMPLATE => 'test'
        ]);

        $transition = new WorkflowTransition([
            WorkflowTransition::FIELD__NAME => 'test'
        ]);

        $dispatchers = $schema->getTriggersByTransition($transition);
        $this->assertCount(1, $dispatchers);
        $first = array_shift($dispatchers);
        $this->assertEquals('test', $first->getName());

        $dispatchers = $schema->getTriggersByTransition($transition->getName());
        $this->assertCount(1, $dispatchers);
        $first = array_shift($dispatchers);
        $this->assertEquals('test', $first->getName());
    }

    /**
     * @throws 
     */
    public function testGetTransitions()
    {
        $schema = new WorkflowSchema([
            WorkflowSchema::FIELD__TRANSITIONS => ['test']
        ]);

        $this->assertTrue($schema->hasTransition('test'));
        $this->assertEquals(['test'], $schema->getTransitionsNames());
        $this->transitionRepo->create(new WorkflowTransition([
            WorkflowTransition::FIELD__NAME => 'test'
        ]));

        $transitions = $schema->getTransitions();
        $this->assertCount(1, $transitions);
        $first = array_shift($transitions);
        $this->assertEquals('test', $first->getName());
    }


}
