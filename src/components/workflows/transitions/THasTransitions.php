<?php
namespace extas\components\workflows\transitions;

use extas\components\SystemContainer;
use extas\components\workflows\exceptions\transitions\ExceptionTransitionMissed;
use extas\components\workflows\THasItems;
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
    use THasItems;

    /**
     * @return string[]
     */
    public function getTransitionsNames(): array
    {
        return $this->getItemsNames(IHasTransitions::FIELD__TRANSITIONS_NAMES);
    }

    /**
     * @return ITransition[]
     */
    public function getTransitions(): array
    {
        return $this->getItems(
            'getTransitionRepository',
            IHasTransitions::FIELD__TRANSITIONS_NAMES
        );
    }

    /**
     * @param string $transitionName
     * @return ITransition|null
     */
    public function getTransition(string $transitionName): ?ITransition
    {
        return $this->getItem(
            'getTransitionRepository',
            IHasTransitions::FIELD__TRANSITIONS_NAMES,
            $transitionName
        );
    }

    /**
     * @param string $transitionName
     * @return bool
     */
    public function hasTransitionName(string $transitionName): bool
    {
        return $this->hasItemName(IHasTransitions::FIELD__TRANSITIONS_NAMES, $transitionName);
    }

    /**
     * @param array $transitionsNames
     * @return $this
     */
    public function setTransitionsNames(array $transitionsNames)
    {
        return $this->setItemsNames(IHasTransitions::FIELD__TRANSITIONS_NAMES, $transitionsNames);
    }

    /**
     * @param string $transitionName
     * @return $this
     */
    public function addTransitionName(string $transitionName)
    {
        return $this->addItemName(IHasTransitions::FIELD__TRANSITIONS_NAMES, $transitionName);
    }

    /**
     * @param string $transitionName
     * @return $this
     * @throws IExceptionTransitionMissed
     */
    public function removeTransitionName(string $transitionName)
    {
        return $this->removeItemName(
            IHasTransitions::FIELD__TRANSITIONS_NAMES,
            ExceptionTransitionMissed::class,
            $transitionName
        );
    }

    /**
     * @return ITransitionRepository
     */
    protected function getTransitionRepository()
    {
        return SystemContainer::getItem(ITransitionRepository::class);
    }
}
