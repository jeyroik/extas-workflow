<?php
namespace extas\interfaces\workflows\states;

use extas\interfaces\workflows\exceptions\states\IExceptionStateMissed;

/**
 * Interface IHasStates
 *
 * @package extas\interfaces\workflows\states
 * @author jeyroik@gmail.com
 */
interface IHasStates
{
    public const FIELD__STATES_NAMES = 'states_names';

    /**
     * @return string[]
     */
    public function getStatesNames(): array;

    /**
     * @return IState[]
     */
    public function getStates(): array;

    /**
     * @param string $name
     * @return IState|null
     */
    public function getState(string $name): ?IState;

    /**
     * @param string $stateName
     * @return bool
     */
    public function hasStateName(string $stateName): bool;

    /**
     * @param array $names
     * @return $this
     */
    public function setStatesNames(array $names);

    /**
     * @param string $name
     * @return $this
     */
    public function addStateName(string $name);

    /**
     * @param string $name
     * @return $this
     * @throws IExceptionStateMissed
     */
    public function removeStateName(string $name);
}
