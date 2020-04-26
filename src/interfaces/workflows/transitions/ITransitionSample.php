<?php
namespace extas\interfaces\workflows\transitions;

use extas\interfaces\samples\ISample;
use extas\interfaces\workflows\states\IState;

interface ITransitionSample extends ISample
{
    public const FIELD__STATE_FROM = 'state_from';
    public const FIELD__STATE_TO = 'state_to';

    /**
     * @return string
     */
    public function getStateFromName(): string;

    /**
     * @return IState|null
     */
    public function getStateFrom(): ?IState;

    /**
     * @return string
     */
    public function getStateToName(): string;

    /**
     * @return IState|null
     */
    public function getStateTo(): ?IState;

    /**
     * @param string $stateName
     *
     * @return ITransitionSample
     */
    public function setStateFromName(string $stateName): ITransitionSample;

    /**
     * @param string $stateName
     *
     * @return ITransitionSample
     */
    public function setStateToName(string $stateName): ITransitionSample;
}
