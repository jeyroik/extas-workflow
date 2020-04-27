<?php
namespace extas\components\workflows\states;

use extas\components\workflows\exceptions\states\ExceptionStateMissed;
use extas\components\SystemContainer;
use extas\components\workflows\THasItems;
use extas\interfaces\workflows\exceptions\states\IExceptionStateMissed;
use extas\interfaces\workflows\states\IHasStates;
use extas\interfaces\workflows\states\IState;
use extas\interfaces\workflows\states\IStateRepository;

/**
 * Trait THasStates
 *
 * @property $config
 *
 * @package extas\components\workflows\states
 * @author jeyroik@gmail.com
 */
trait THasStates
{
    use THasItems;

    /**
     * @return string[]
     */
    public function getStatesNames(): array
    {
        return $this->getItemsNames(IHasStates::FIELD__STATES_NAMES);
    }

    /**
     * @return IState[]
     */
    public function getStates(): array
    {
        return $this->getItems('getStatesRepository', IHasStates::FIELD__STATES_NAMES);
    }

    /**
     * @param string $name
     * @return IState|null
     */
    public function getState(string $name): ?IState
    {
        return $this->getItem('getStatesRepository', IHasStates::FIELD__STATES_NAMES, $name);
    }

    /**
     * @param string $stateName
     * @return bool
     */
    public function hasStateName(string $stateName): bool
    {
        return $this->hasItemName(IHasStates::FIELD__STATES_NAMES, $stateName);
    }

    /**
     * @param array $names
     * @return $this
     */
    public function setStatesNames(array $names)
    {
        return $this->setItemsNames(IHasStates::FIELD__STATES_NAMES, $names);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function addStateName(string $name)
    {
        return $this->addItemName(IHasStates::FIELD__STATES_NAMES, $name);
    }

    /**
     * @param string $name
     * @return $this
     * @throws IExceptionStateMissed
     */
    public function removeStateName(string $name)
    {
        return $this->removeItemName(
            IHasStates::FIELD__STATES_NAMES,
            ExceptionStateMissed::class,
            $name
        );
    }

    /**
     * @return IStateRepository
     */
    protected function getStatesRepository()
    {
        return SystemContainer::getItem(IStateRepository::class);
    }
}
