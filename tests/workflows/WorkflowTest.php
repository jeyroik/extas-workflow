<?php
namespace tests\workflows;

use Dotenv\Dotenv;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\THasMagicClass;
use PHPUnit\Framework\TestCase;
use extas\interfaces\workflows\transits\ITransitResult;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcher;
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
    use TSnuffRepositoryDynamic;
    use THasMagicClass;

    protected function setUp(): void
    {
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([
            ['workflowTransitionsDispatchers', 'name', TransitionDispatcher::class]
        ]);
    }

    public function tearDown(): void
    {
        $this->deleteSnuffDynamicRepositories();
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
            Transition::FIELD__NAME => 'test'
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
            Transition::FIELD__NAME => 'test'
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
            Transition::FIELD__NAME => 'test'
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
        $this->getMagicClass('workflowTransitionsDispatchers')->create(new TransitionDispatcher([
            TransitionDispatcher::FIELD__NAME => $name,
            TransitionDispatcher::FIELD__TITLE => 'test',
            TransitionDispatcher::FIELD__CLASS => $className,
            TransitionDispatcher::FIELD__TYPE => $type,
            TransitionDispatcher::FIELD__TRANSITION_NAME => 'test'
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
