<?php

use PHPUnit\Framework\TestSuite;
use extas\interfaces\workflows\schemas\IWorkflowSchemaRepository;
use extas\interfaces\workflows\entities\IWorkflowEntityTemplateRepository;
use extas\interfaces\repositories\IRepository;
use extas\components\SystemContainer;
use extas\components\workflows\schemas\WorkflowSchema;
use extas\components\workflows\entities\WorkflowEntityTemplate;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherRepository;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcher;

/**
 * Class WorkflowSchemaTest
 *
 * @author jeyroik@gmail.com
 */
class WorkflowSchemaTest extends TestSuite
{
    /**
     * @var IRepository|null
     */
    protected ?IRepository $entityTemplateRepo = null;

    /**
     * @var IRepository|null
     */
    protected ?IRepository $transitionDispatcherRepo = null;

    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->entityTemplateRepo = SystemContainer::getItem(IWorkflowEntityTemplateRepository::class);
        $this->transitionDispatcherRepo = SystemContainer::getItem(ITransitionDispatcherRepository::class);
    }

    public function tearDown(): void
    {
        $this->entityTemplateRepo->delete([WorkflowEntityTemplate::FIELD__NAME => 'test']);
        $this->transitionDispatcherRepo->delete([TransitionDispatcher::FIELD__NAME => 'test']);
    }

    public function testIsApplicableEntityTemplate()
    {
        $schema = new WorkflowSchema();
        $schema->setEntityTemplateName('test');
        $this->assertEquals(true, $schema->isApplicableEntityTemplate('test'));
    }

    public function testGetEntityTemplate()
    {
        $this->entityTemplateRepo->create(new WorkflowEntityTemplate([
            WorkflowEntityTemplate::FIELD__NAME => 'test',
            WorkflowEntityTemplate::FIELD__TITLE => 'Test'
        ]));

        $schema = new WorkflowSchema([
            WorkflowSchema::FIELD__ENTITY_TEMPLATE => 'test'
        ]);

        $template = $schema->getEntityTemplate();
        $this->assertEquals('Test', $template->getTitle());
    }

    public function testGetConditions()
    {
        $this->transitionDispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test',
            TransitionDispatcher::FIELD__SCHEMA_NAME => 'test',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__CONDITION
        ]));

        $schema = new WorkflowSchema([
            WorkflowSchema::FIELD__ENTITY_TEMPLATE => 'test'
        ]);

        $conditions = $schema->getConditions();
        $firstCondition = array_shift($conditions);
        $this->assertEquals('test', $firstCondition->getName());
    }

    public function testGetValidators()
    {
        $this->transitionDispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test',
            TransitionDispatcher::FIELD__SCHEMA_NAME => 'test',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__VALIDATOR
        ]));

        $schema = new WorkflowSchema([
            WorkflowSchema::FIELD__ENTITY_TEMPLATE => 'test'
        ]);

        $dispatchers = $schema->getValidators();
        $first = array_shift($dispatchers);
        $this->assertEquals('test', $first->getName());
    }

    public function testGetConditionsByTransition()
    {
        $this->transitionDispatcherRepo->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => 'test',
            TransitionDispatcher::FIELD__SCHEMA_NAME => 'test',
            TransitionDispatcher::FIELD__TYPE => TransitionDispatcher::TYPE__CONDITION
        ]));

        $schema = new WorkflowSchema([
            WorkflowSchema::FIELD__ENTITY_TEMPLATE => 'test'
        ]);

        $conditions = $schema->getConditions();
        $firstCondition = array_shift($conditions);
        $this->assertEquals('test', $firstCondition->getName());
    }
}
