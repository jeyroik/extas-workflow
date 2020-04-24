<?php
namespace tests;

use extas\components\plugins\Plugin;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transitions\IWorkflowTransition;
use extas\interfaces\workflows\transitions\results\ITransitionResult;

/**
 * Class TriggerChangeEntity
 *
 * @package tests
 * @author jeyroik@gmail.com
 */
class TriggerChangeEntity extends Plugin implements ITransitionDispatcherExecutor
{
    public const FIELD__TEST = 'test_trigger';

    /**
     * @param ITransitionDispatcher $dispatcher
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entitySource
     * @param IWorkflowSchema $schema
     * @param IItem $context
     * @param ITransitionResult $result
     * @param IWorkflowEntity $entityEdited
     * @return bool
     */
    public function __invoke(
        ITransitionDispatcher $dispatcher,
        IWorkflowTransition $transition,
        IWorkflowEntity $entitySource,
        IWorkflowSchema $schema,
        IItem $context,
        ITransitionResult &$result,
        IWorkflowEntity &$entityEdited
    ): bool
    {
        $entityEdited[static::FIELD__TEST] = 'is ok';

        return true;
    }
}
