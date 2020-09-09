<?php
namespace extas\interfaces\workflows\transitions;

use extas\interfaces\IItem;
use extas\interfaces\workflows\exceptions\transitions\IExceptionTransitionMissed;

/**
 * Interface IHasTransitions
 *
 * Applicable only for schemas.
 *
 * @package extas\interfaces\workflows\transitions
 * @author jeyroik@gmail.com
 */
interface IHasTransitions
{
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
    public function hasTransition(string $transitionName): bool;
}
