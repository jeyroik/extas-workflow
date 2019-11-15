<?php
namespace extas\interfaces\workflows\transitions\dispatchers;

use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\transitions\IWorkflowTransition;
use extas\interfaces\workflows\transitions\results\ITransitionResult;

/**
 * Interface ITransitionDispatcherExecutor
 *
 * @package extas\interfaces\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
interface ITransitionDispatcherExecutor
{
    /**
     * @param ITransitionDispatcher $dispatcher
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entity
     * @param IWorkflowSchema $schema
     * @param IItem $context
     * @param ITransitionResult $result
     *
     * @return bool
     */
    public function __invoke(
        ITransitionDispatcher $dispatcher,
        IWorkflowTransition $transition,
        IWorkflowEntity $entity,
        IWorkflowSchema $schema,
        IItem $context,
        ITransitionResult &$result
    );
}
