<?php
namespace extas\components\workflows;

use extas\components\Item;
use extas\components\SystemContainer;
use extas\components\THasContext;
use extas\components\workflows\transitions\results\TransitionResult;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\IWorkflow;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\states\IWorkflowState;
use extas\interfaces\workflows\transitions\errors\ITransitionErrorVocabulary;
use extas\interfaces\workflows\transitions\IWorkflowTransition;
use extas\interfaces\workflows\transitions\IWorkflowTransitionRepository;
use extas\interfaces\workflows\transitions\results\ITransitionResult;

/**
 * Class Workflow
 *
 * @package extas\components\workflows
 * @author jeyroik@gmail.com
 */
class Workflow extends Item implements IWorkflow
{
    use THasContext;

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
    ): ITransitionResult
    {
        $static = new static([
            static::FIELD__SCHEMA => $bySchema,
            static::FIELD__CONTEXT => $withContext
        ]);

        if (!$bySchema->isApplicableEntityTemplate($entity->getTemplateName())) {
            return (new TransitionResult())->fail(
                ITransitionErrorVocabulary::ERROR__NOT_APPLICABLE_ENTITY_TEMPLATE,
                ['template' => $entity->getTemplateName()]
            );
        }

        if ($bySchema->hasTransition($transitionName)) {
            $transition = $static->getTransition($transitionName);
            $toState = $transition->getStateToName();
            return $static->runTransit($entity, $toState, $transition);
        }

        return (new TransitionResult())->fail(
            ITransitionErrorVocabulary::ERROR__UNKNOWN_TRANSITION,
            [
                'schema' => $bySchema->getName(),
                'transition' => $transitionName
            ]
        );
    }

    /**
     * @param IWorkflowEntity $entity
     * @param IWorkflowState|string $toState
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
    ): ITransitionResult
    {
        $static = new static([
            static::FIELD__SCHEMA => $bySchema,
            static::FIELD__CONTEXT => $withContext
        ]);

        if (!$bySchema->isApplicableEntityTemplate($entity->getTemplateName())) {
            return (new TransitionResult())->fail(
                ITransitionErrorVocabulary::ERROR__NOT_APPLICABLE_ENTITY_TEMPLATE,
                ['template' => $entity->getTemplateName()]
            );
        }

        if ($bySchema->canTransit($entity, $withContext, $toState)) {
            $toState = $toState instanceof IWorkflowState ? $toState->getName() : (string) $toState;
            $transition = $bySchema->getTransition($entity, $withContext, $toState);

            return $static->runTransit($entity, $toState, $transition);
        }

        return (new TransitionResult())->fail(
            ITransitionErrorVocabulary::ERROR__CAN_NOT_TRANSIT_TO_STATE,
            [
                'schema' => $bySchema->getName(),
                'transition' => $toState
            ]
        );
    }

    /**
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entity
     * @param ITransitionResult $result
     *
     * @return ITransitionResult
     */
    public function isTransitionValid($transition, $entity, $result): ITransitionResult
    {
        $bySchema = $this->getSchema();
        $conditions = $bySchema->getConditionsByTransition($transition, $this->getContext());
        $entityEdited = clone $entity;
        foreach ($conditions as $condition) {
            if (!$condition->dispatch($transition, $entity, $result, $entityEdited)) {
                return $result;
            }
        }

        if (!isset($withContext[static::CONTEXT__CONDITIONS])) {
            $validators = $bySchema->getValidatorsByTransition($transition, $this->getContext());

            foreach ($validators as $validator) {
                if (!$validator->dispatch($transition, $entity, $result, $entityEdited)) {
                    return $result;
                }
            }
        }

        return $result;
    }

    /**
     * @param IWorkflowEntity $entity
     * @param string $toState
     * @param IWorkflowTransition $transition
     *
     * @return ITransitionResult
     */
    protected function runTransit(
        IWorkflowEntity &$entity,
        string $toState,
        IWorkflowTransition $transition
    ): ITransitionResult
    {
        $result = new TransitionResult();

        if ($this->isTransitionValid($transition, $entity, $result)) {
            $entity = $entity->setStateName($toState);
            $this->triggerTransitionEnd($transition, $entity, $result);

            return $result;
        }

        return $result->fail(
            ITransitionErrorVocabulary::ERROR__VALIDATION_FAILED,
            [
                'entity' => $entity->__toArray()
            ]
        );
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
     * @param ITransitionResult $result
     *
     * @return ITransitionResult
     */
    protected function triggerTransitionEnd($transition, &$entity, $result): ITransitionResult
    {
        $bySchema = $this->getSchema();
        $triggers = $bySchema->getTriggersByTransition($transition, $this->getContext());
        $entityEdited = clone $entity;

        foreach ($triggers as $trigger) {
            $trigger->dispatch($transition, $entity, $result, $entityEdited);
        }

        $entity = $entityEdited;

        return $result;
    }

    /**
     * @return IWorkflowSchema|null
     */
    public function getSchema(): ?IWorkflowSchema
    {
        return $this->config[static::FIELD__SCHEMA] ?? null;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
