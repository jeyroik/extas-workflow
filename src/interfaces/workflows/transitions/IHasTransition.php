<?php
namespace extas\interfaces\workflows\transitions;

/**
 * Interface IHasTransition
 *
 * @package extas\interfaces\workflows\transitions
 * @author jeyroik@gmail.com
 */
interface IHasTransition
{
    public const FIELD__TRANSITION_NAME = 'transition_name';

    /**
     * @return string
     */
    public function getTransitionName(): string;

    /**
     * @return ITransition|null
     */
    public function getTransition(): ?ITransition;

    /**
     * @param string $transitionName
     * @return $this
     */
    public function setTransitionName(string $transitionName);
}
