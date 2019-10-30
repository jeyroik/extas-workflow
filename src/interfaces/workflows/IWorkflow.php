<?php
namespace extas\interfaces\workflows;

use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\states\IWorkflowState;

/**
 * Interface IWorkflow
 *
 * @package extas\interfaces\workflows
 * @author jeyroik@gmail.com
 */
interface IWorkflow extends IItem
{
    const SUBJECT = 'extas.workflow';

    /**
     * @param IWorkflowEntity $entity
     * @param string $transitionName
     * @param IWorkflowSchema $bySchema
     * @param IItem $withContext
     *
     * @return bool
     */
    public static function transitByTransition(
        IWorkflowEntity &$entity,
        string $transitionName,
        IWorkflowSchema $bySchema,
        IItem $withContext
    ): bool;

    /**
     * @param IWorkflowEntity $entity
     * @param string|IWorkflowState $toState
     * @param IWorkflowSchema $bySchema
     * @param IItem $withContext
     *
     * @return bool
     */
    public static function transitByState(
        IWorkflowEntity &$entity,
        $toState,
        IWorkflowSchema $bySchema,
        IItem $withContext
    ): bool;
}
