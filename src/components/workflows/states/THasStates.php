<?php
namespace extas\components\workflows\states;

use extas\components\SystemContainer;
use extas\components\workflows\exceptions\states\ExceptionStateMissed;
use extas\interfaces\repositories\IRepository;
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
    /**
     * @return string[]
     */
    public function getStatesNames(): array
    {
        return $this->config[IHasStates::FIELD__STATES_NAMES] ?? [];
    }

    /**
     * @return IState[]
     */
    public function getStates(): array
    {
        /**
         * @var IRepository $repo
         */
        $repo = SystemContainer::getItem(IStateRepository::class);

        return $repo->all([IState::FIELD__NAME => $this->getStatesNames()]);
    }

    /**
     * @param string $name
     * @return IState|null
     */
    public function getState(string $name): ?IState
    {
        if ($this->hasStateName($name)) {
            /**
             * @var IRepository $repo
             */
            $repo = SystemContainer::getItem(IStateRepository::class);
            return $repo->one([IState::FIELD__NAME => $name]);
        }

        return null;
    }

    /**
     * @param string $stateName
     * @return bool
     */
    public function hasStateName(string $stateName): bool
    {
        return in_array($stateName, $this->getStatesNames());
    }

    /**
     * @param array $names
     * @return $this
     */
    public function setStatesNames(array $names)
    {
        $this->config[IHasStates::FIELD__STATES_NAMES] = $names;

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function addStateName(string $name)
    {
        if (!$this->hasStateName($name)) {
            $states = $this->getStatesNames();
            $states[] = $name;
            $this->setStatesNames($states);
        }

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     * @throws IExceptionStateMissed
     */
    public function removeStateName(string $name)
    {
        if ($this->hasStateName($name)) {
            $states = array_flip($this->getStatesNames());
            unset($states[$name]);
            $this->setStatesNames(array_keys($states));

            return $this;
        }

        throw new ExceptionStateMissed($name);
    }
}
