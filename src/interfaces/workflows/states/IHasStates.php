<?php
namespace extas\interfaces\workflows\states;

use extas\interfaces\workflows\exceptions\states\IExceptionStateMissed;

/**
 * Interface IHasStates
 *
 * Applicable only for schemas.
 *
 * @package extas\interfaces\workflows\states
 * @author jeyroik@gmail.com
 */
interface IHasStates
{
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
     * @param string $name
     * @return bool
     */
    public function hasState(string $name): bool;
}
