<?php
namespace extas\components\workflows\transitions;

use extas\components\SystemContainer;
use extas\components\workflows\exceptions\transitions\ExceptionTransitionMissed;
use extas\interfaces\workflows\exceptions\transitions\IExceptionTransitionMissed;
use extas\interfaces\workflows\transitions\IHasTransitions;
use extas\interfaces\workflows\transitions\ITransition;
use extas\interfaces\workflows\transitions\ITransitionRepository;

/**
 * Trait THasTransitions
 *
 * @property array $config
 *
 * @package extas\components\workflows\transitions
 * @author jeyroik@gmail.com
 */
trait THasTransitions
{
    /**
     * @return string[]
     */
    public function getTransitionsNames(): array
    {
        return $this->config[IHasTransitions::FIELD__TRANSITIONS_NAMES] ?? [];
    }

    /**
     * @return ITransition[]
     */
    public function getTransitions(): array
    {
        return $this->getRepository()->all([ITransition::FIELD__NAME => $this->getTransitionsNames()]);
    }

    /**
     * @param string $transitionName
     * @return ITransition|null
     */
    public function getTransition(string $transitionName): ?ITransition
    {
        if ($this->hasTransitionName($transitionName)) {
            return $this->getRepository()->one([ITransition::FIELD__NAME => $transitionName]);
        }

        return null;
    }

    /**
     * @param string $transitionName
     * @return bool
     */
    public function hasTransitionName(string $transitionName): bool
    {
        return in_array($transitionName, $this->getTransitionsNames());
    }

    /**
     * @param array $transitionsNames
     * @return $this
     */
    public function setTransitionsNames(array $transitionsNames)
    {
        $this->config[IHasTransitions::FIELD__TRANSITIONS_NAMES] = $transitionsNames;

        return $this;
    }

    /**
     * @param string $transitionName
     * @return $this
     */
    public function addTransitionName(string $transitionName)
    {
        if (!$this->hasTransitionName($transitionName)) {
            $names = $this->getTransitionsNames();
            $names[] = $transitionName;
            $this->setTransitionsNames($names);
        }

        return $this;
    }

    /**
     * @param string $transitionName
     * @return $this
     * @throws IExceptionTransitionMissed
     */
    public function removeTransitionName(string $transitionName)
    {
        if ($this->hasTransitionName($transitionName)) {
            $names = array_flip($this->getTransitionsNames());
            unset($names[$transitionName]);
            $this->setTransitionsNames(array_keys($names));

            return $this;
        }

        throw new ExceptionTransitionMissed($transitionName);
    }

    /**
     * @return ITransitionRepository
     */
    protected function getRepository()
    {
        return SystemContainer::getItem(ITransitionRepository::class);
    }
}
