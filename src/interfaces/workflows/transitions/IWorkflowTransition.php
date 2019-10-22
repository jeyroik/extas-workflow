<?php
namespace extas\interfaces\workflows\transitions;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\workflows\states\IWorkflowState;

/**
 * Interface ITransition
 *
 * @package extas\interfaces\workflows\transitions
 * @author jeyroik@gmail.com
 */
interface IWorkflowTransition extends IItem, IHasName, IHasDescription
{
    const SUBJECT = 'extas.workflow.transition';

    const FIELD__STATE_FROM = 'state_from';
    const FIELD__STATE_TO = 'state_to';

    /**
     * @return IWorkflowState|null
     */
    public function getStateFrom(): ?IWorkflowState;

    /**
     * @return string
     */
    public function getStateFromName(): string;

    /**
     * @return IWorkflowState|null
     */
    public function getStateTo(): ?IWorkflowState;

    /**
     * @return string
     */
    public function getStateToName(): string;

    /**
     * @param string|IWorkflowState $state
     *
     * @return IWorkflowTransition
     */
    public function setStateFrom($state): IWorkflowTransition;

    /**
     * @param string|IWorkflowState $state
     *
     * @return IWorkflowTransition
     */
    public function setStateTo($state): IWorkflowTransition;
}
