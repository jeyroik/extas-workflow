<?php
namespace extas\interfaces\workflows\schemas;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHasParameters;
use extas\interfaces\workflows\states\IWorkflowState;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\IWorkflowTransition;
use extas\interfaces\workflows\triggers\IWorkflowTrigger;
use extas\interfaces\workflows\validators\IWorkflowValidator;

/**
 * Interface IWorkflowSchema
 *
 * @package extas\interfaces\workflows\schemas
 * @author jeyroik@gmail.com
 */
interface IWorkflowSchema extends IItem, IHasName, IHasDescription, IHasParameters
{
    const SUBJECT = 'extas.workflow';

    const FIELD__STATES = 'states';
    const FIELD__TRANSITIONS = 'transitions';
    const FIELD__VALIDATORS = 'validators';
    const FIELD__TRIGGERS = 'triggers';

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
     * @return IWorkflowState[]
     */
    public function getStates(): array;

    /**
     * @return string[]
     */
    public function getStatesNames(): array;

    /**
     * @param string $stateName
     *
     * @return bool
     */
    public function hasState(string $stateName): bool;

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
     * @param string|IWorkflowState $state
     *
     * @return IWorkflowTransition[]
     */
    public function getAvailableTransitionsByFromState($state): array;

    /**
     * @param string|IWorkflowState $state
     *
     * @return IWorkflowTransition[]
     */
    public function getAvailableTransitionsByToState($state): array;

    /**
     * @param string|IWorkflowState $stateFrom
     * @param string|IWorkflowTransition $stateTo
     *
     * @return IWorkflowTransition|null
     */
    public function getTransition($stateFrom, $stateTo): ?IWorkflowTransition;

    /**
     * @param string|IWorkflowState $stateFrom
     * @param string|IWorkflowState $stateTo
     *
     * @return bool
     */
    public function canTransit($stateFrom, $stateTo): bool;

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
     * @param string[]|IWorkflowState[] $states
     *
     * @return IWorkflowSchema
     */
    public function setStates(array $states): IWorkflowSchema;

    /**
     * @param IWorkflowState|string $state
     *
     * @return IWorkflowSchema
     */
    public function addState($state): IWorkflowSchema;

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
}
