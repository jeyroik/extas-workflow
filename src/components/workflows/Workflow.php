<?php
namespace extas\components\workflows;

use extas\components\Item;
use extas\components\SystemContainer;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\IWorkflow;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\states\IWorkflowState;
use extas\interfaces\workflows\transitions\IWorkflowTransition;
use extas\interfaces\workflows\transitions\IWorkflowTransitionRepository;

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
    ): bool
    {
        $static = new static();

        if (!$bySchema->isApplicableEntityTemplate($entity->getTemplateName())) {
            return false;
        }

        if ($bySchema->hasTransition($transitionName)) {
            $transition = $static->getTransition($transitionName);
            $toState = $transition->getStateToName();
            return $static->runTransit($entity, $toState, $bySchema, $withContext, $transition);
        }

        return false;
    }

    /**
     * @param IWorkflowEntity $entity
     * @param IWorkflowState|string $toState
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
    ): bool
    {
        $static = new static();

        if (!$bySchema->isApplicableEntityTemplate($entity->getTemplateName())) {
            return false;
        }

        if ($bySchema->canTransit($entity, $withContext, $toState)) {
            $toState = $toState instanceof IWorkflowState ? $toState->getName() : (string) $toState;
            $transition = $bySchema->getTransition($entity, $withContext, $toState);

            return $static->runTransit($entity, $toState, $bySchema, $withContext, $transition);
        }

        return false;
    }

    /**
     * @param IWorkflowEntity $entity
     * @param string $toState
     * @param IWorkflowSchema $bySchema
     * @param IItem $withContext
     * @param IWorkflowTransition $transition
     *
     * @return bool
     */
    protected function runTransit(
        IWorkflowEntity &$entity,
        string $toState,
        IWorkflowSchema $bySchema,
        IItem $withContext,
        IWorkflowTransition $transition
    ): bool
    {
        $stage = 'workflow.transition';
        foreach ($this->getPluginsByStage($stage) as $plugin) {
            $plugin($entity, $toState, $transition, $bySchema, $withContext);
        }

        $stage = 'workflow.from.' . $entity->getStateName();
        foreach ($this->getPluginsByStage($stage) as $plugin) {
            $plugin($entity, $toState, $transition, $bySchema, $withContext);
        }

        $stage = 'workflow.to.' . $toState;
        foreach ($this->getPluginsByStage($stage) as $plugin) {
            $plugin($entity, $toState, $transition, $bySchema, $withContext);
        }

        $stage = 'workflow.' . $bySchema->getName();
        foreach ($this->getPluginsByStage($stage) as $plugin) {
            $plugin($entity, $toState, $transition, $bySchema, $withContext);
        }

        $stage = 'workflow.' . $transition->getName();
        foreach ($this->getPluginsByStage($stage) as $plugin) {
            $plugin($entity, $toState, $transition, $bySchema, $withContext);
        }

        $stage = 'workflow.' . $bySchema->getName() . '.' . $transition->getName();
        foreach ($this->getPluginsByStage($stage) as $plugin) {
            $plugin($entity, $toState, $transition, $bySchema, $withContext);
        }

        if ($this->isTransitionValid($transition, $entity, $bySchema, $withContext)) {
            $entity = $entity->setStateName($toState);
            $this->triggerTransitionEnd($transition, $entity, $bySchema, $withContext);
            return true;
        }

        return false;
    }

    /**
     * @param string $transitionName
     *
     * @return IWorkflowTransition|null
     */
    protected function getTransition(string $transitionName): ?IWorkflowTransition
    {
        return SystemContainer::getItem(IWorkflowTransitionRepository::class)->one([
            IWorkflowTransition::FIELD__NAME => $transitionName
        ]);
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
