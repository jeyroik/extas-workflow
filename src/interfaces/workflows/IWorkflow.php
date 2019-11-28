<?php
namespace extas\interfaces\workflows;

use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\states\IWorkflowState;
use extas\interfaces\workflows\transitions\IWorkflowTransition;
use extas\interfaces\workflows\transitions\results\ITransitionResult;

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
     * @return ITransitionResult
     */
    public static function transitByTransition(
        IWorkflowEntity &$entity,
        string $transitionName,
        IWorkflowSchema $bySchema,
        IItem $withContext
    ): ITransitionResult;

    /**
     * @param IWorkflowEntity $entity
     * @param string|IWorkflowState $toState
     * @param IWorkflowSchema $bySchema
     * @param IItem $withContext
     *
     * @return ITransitionResult
     */
    public static function transitByState(
        IWorkflowEntity &$entity,
        $toState,
        IWorkflowSchema $bySchema,
        IItem $withContext
    ): ITransitionResult;

    /**
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entity
     * @param IWorkflowSchema $bySchema
     * @param IItem $withContext
     * @param ITransitionResult $result
     *
     * @return ITransitionResult
     */
    public function isTransitionValid($transition, $entity, $bySchema, $withContext, $result): ITransitionResult;
}
