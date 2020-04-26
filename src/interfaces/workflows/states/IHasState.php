<?php
namespace extas\interfaces\workflows\states;

/**
 * Interface IHasState
 *
 * @package extas\interfaces\workflows\states
 * @author jeyroik@gmail.com
 */
interface IHasState
{
    public const FIELD__STATE_NAME = 'state_name';

    /**
     * @return string
     */
    public function getStateName(): string;

    /**
     * @return IState|null
     */
    public function getState(): ?IState;

    /**
     * @param string $name
     * @return $this
     */
    public function setStateName(string $name);
}
