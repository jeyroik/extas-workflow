<?php
namespace extas\components\workflows;

use extas\components\Item;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\IWorkflow;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\states\IWorkflowState;
use extas\interfaces\workflows\transitions\IWorkflowTransition;

/**
 * Class Workflow
 *
 * @package extas\components\workflows
 * @author jeyroik@gmail.com
 */
class Workflow extends Item implements IWorkflow
{
    /**
     * @param IWorkflowEntity $entity
     * @param IWorkflowState|string $toState
     * @param IWorkflowSchema $bySchema
     * @param IItem $withContext
     *
     * @return bool
     */
    public static function transit(
        IWorkflowEntity &$entity,
        $toState,
        IWorkflowSchema $bySchema,
        IItem $withContext
    ): bool
    {
        $static = new static();

        if ($bySchema->canTransit($entity->getStateName(), $toState)) {
            $toState = $toState instanceof IWorkflowState ? $toState->getName() : (string) $toState;
            $transition = $bySchema->getTransition($entity->getStateName(), $toState);

            $stage = 'workflow.transition';
            foreach ($static->getPluginsByStage($stage) as $plugin) {
                $plugin($entity, $toState, $transition, $bySchema, $withContext);
            }

            $stage = 'workflow.from.' . $entity->getStateName();
            foreach ($static->getPluginsByStage($stage) as $plugin) {
                $plugin($entity, $toState, $transition, $bySchema, $withContext);
            }

            $stage = 'workflow.to.' . $toState;
            foreach ($static->getPluginsByStage($stage) as $plugin) {
                $plugin($entity, $toState, $transition, $bySchema, $withContext);
            }

            $stage = 'workflow.' . $transition->getName();
            foreach ($static->getPluginsByStage($stage) as $plugin) {
                $plugin($entity, $toState, $transition, $bySchema, $withContext);
            }

            if ($static->isTransitionValid($transition, $entity, $bySchema, $withContext)) {
                $entity = $entity->setStateName($toState);
                $static->triggerTransitionEnd($transition, $entity, $bySchema, $withContext);
                return true;
            }
        }

        return false;
    }

    /**
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entity
     * @param IWorkflowSchema $bySchema
     * @param IItem $withContext
     *
     * @return bool
     */
    protected function triggerTransitionEnd($transition, $entity, $bySchema, $withContext)
    {
        $triggers = $bySchema->getTriggersByTransition($transition);

        foreach ($triggers as $trigger) {
            $trigger->dispatch($transition, $entity, $bySchema, $withContext);
        }

        return true;
    }

    /**
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entity
     * @param IWorkflowSchema $bySchema
     * @param IItem $withContext
     *
     * @return bool
     */
    protected function isTransitionValid($transition, $entity, $bySchema, $withContext): bool
    {
        $validators = $bySchema->getValidatorsByTransition($transition);

        foreach ($validators as $validator) {
            if (!$validator->dispatch($transition, $entity, $bySchema, $withContext)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
