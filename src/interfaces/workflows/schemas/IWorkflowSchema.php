<?php
namespace extas\interfaces\workflows\schemas;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHasParameters;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\entities\IWorkflowEntityTemplate;
use extas\interfaces\workflows\states\IWorkflowState;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\IWorkflowTransition;

/**
 * Interface IWorkflowSchema
 *
 * @package extas\interfaces\workflows\schemas
 * @author jeyroik@gmail.com
 */
interface IWorkflowSchema extends IItem, IHasName, IHasDescription, IHasParameters
{
    public const SUBJECT = 'extas.workflow';

    public const FIELD__STATES = 'states';
    public const FIELD__TRANSITIONS = 'transitions';
    public const FIELD__ENTITY_TEMPLATE = 'entity_template';

    /**
     * @param string $templateName
     *
     * @return bool
     */
    public function isApplicableEntityTemplate(string $templateName): bool;

    /**
     * @return IWorkflowEntityTemplate
     */
    public function getEntityTemplate(): ?IWorkflowEntityTemplate;

    /**
     * @return string
     */
    public function getEntityTemplateName(): string;

    /**
     * @return ITransitionDispatcher[]
     */
    public function getConditions(): array;

    /**
     * @param IWorkflowTransition|string $transition
     *
     * @return ITransitionDispatcher[]
     */
    public function getConditionsByTransition($transition): array;

    /**
     * @return ITransitionDispatcher[]
     */
    public function getValidators(): array;

    /**
     * @param string|IWorkflowTransition $transition
     *
     * @return ITransitionDispatcher[]
     */
    public function getValidatorsByTransition($transition): array;

    /**
     * @return ITransitionDispatcher[]
     */
    public function getTriggers(): array;

    /**
     * @param string|IWorkflowTransition $transition
     *
     * @return ITransitionDispatcher[]
     */
    public function getTriggersByTransition($transition): array;

    /**
     * @return IWorkflowTransition[]
     */
    public function getTransitions(): array;

    /**
     * @return string[]
     */
    public function getTransitionsNames(): array;

    /**
     * @param string $transitionName
     *
     * @return bool
     */
    public function hasTransition(string $transitionName): bool;

    /**
     * @param IWorkflowEntity $entity
     * @param IItem $context
     *
     * @return IWorkflowTransition[]
     */
    public function getAvailableTransitionsByFromState(IWorkflowEntity $entity, IItem $context): array;

    /**
     * @param IWorkflowEntity $entity
     * @param IItem $context
     *
     * @return IWorkflowTransition[]
     */
    public function getAvailableTransitionsByToState(IWorkflowEntity $entity, IItem $context): array;

    /**
     * @param IWorkflowEntity $entity
     * @param IItem $context
     * @param string|IWorkflowState $stateTo
     *
     * @return IWorkflowTransition|null
     */
    public function getTransition(IWorkflowEntity $entity, IItem $context, $stateTo): ?IWorkflowTransition;

    /**
     * @param IWorkflowEntity $entity
     * @param IItem $context
     * @param string|IWorkflowState $stateTo
     *
     * @return bool
     */
    public function canTransit(IWorkflowEntity $entity, IItem $context, $stateTo): bool;

    /**
     * @param IWorkflowEntityTemplate $template
     *
     * @return IWorkflowSchema
     */
    public function setEntityTemplate(IWorkflowEntityTemplate $template): IWorkflowSchema;

    /**
     * @param string $templateName
     *
     * @return IWorkflowSchema
     */
    public function setEntityTemplateName(string $templateName): IWorkflowSchema;

    /**
     * @param IWorkflowTransition $transition
     * @param string $validatorName
     * @param string $templateName
     * @param array $parameters
     *
     * @return IWorkflowSchema
     */
    public function setValidatorByTransition(
        IWorkflowTransition $transition,
        string $validatorName,
        string $templateName,
        array $parameters
    ): IWorkflowSchema;

    /**
     * @param IWorkflowTransition $transition
     * @param string $triggerName
     * @param string $templateName
     * @param array $parameters
     *
     * @return IWorkflowSchema
     */
    public function setTriggerByTransition(
        IWorkflowTransition $transition,
        string $triggerName,
        string $templateName,
        array $parameters
    ): IWorkflowSchema;

    /**
     * @param IWorkflowTransition $transition
     * @param string $conditionName
     * @param string $templateName
     * @param array $parameters
     *
     * @return IWorkflowSchema
     */
    public function setConditionByTransition(
        IWorkflowTransition $transition,
        string $conditionName,
        string $templateName,
        array $parameters
    ): IWorkflowSchema;

    /**
     * @param string[]|IWorkflowTransition[] $transitions
     *
     * @return IWorkflowSchema
     */
    public function setTransitions(array $transitions): IWorkflowSchema;

    /**
     * @param IWorkflowTransition $transition
     *
     * @return IWorkflowSchema
     */
    public function addTransition(IWorkflowTransition $transition): IWorkflowSchema;

    /**
     * @param IWorkflowTransition $transition
     *
     * @return IWorkflowSchema
     */
    public function removeTransition(IWorkflowTransition $transition): IWorkflowSchema;
}
