<?php
namespace extas\interfaces\workflows\transitions;

use extas\interfaces\workflows\exceptions\transitions\IExceptionTransitionMissed;

/**
 * Interface IHasTransitions
 *
 * @package extas\interfaces\workflows\transitions
 * @author jeyroik@gmail.com
 */
interface IHasTransitions
{
    public const FIELD__TRANSITIONS_NAMES = 'transitions_names';

    /**
     * @return string[]
     */
    public function getTransitionsNames(): array;

    /**
     * @return ITransition[]
     */
    public function getTransitions(): array;

    /**
     * @param string $transitionName
     * @return ITransition|null
     */
    public function getTransition(string $transitionName): ?ITransition;

    /**
     * @param string $transitionName
     * @return bool
     */
    public function hasTransitionName(string $transitionName): bool;

    /**
     * @param array $transitionsNames
     * @return $this
     */
    public function setTransitionsNames(array $transitionsNames);

    /**
     * @param string $transitionName
     * @return $this
     */
    public function addTransitionName(string $transitionName);

    /**
     * @param string $transitionName
     * @return $this
     * @throws IExceptionTransitionMissed
     */
    public function removeTransitionName(string $transitionName);
}
