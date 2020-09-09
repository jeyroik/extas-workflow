<?php
namespace extas\components\workflows\states;

use extas\interfaces\IItem;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\states\IState;
use extas\interfaces\workflows\states\IStateSample;

/**
 * Trait THasStates
 *
 * @property $config
 * @method getName(): string
 * @method IRepository workflowStates()
 * @method IRepository workflowStatesSamples()
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
        return array_column(
            $this->workflowStates()->all([
                IState::FIELD__SCHEMA_NAME => $this->getName()
            ]),
            IState::FIELD__NAME
        );
    }

    /**
     * @return IState[]
     */
    public function getStates(): array
    {
        return $this->workflowStates()->all([
            IState::FIELD__SCHEMA_NAME => $this->getName()
        ]);
    }

    /**
     * @param string $name
     * @return IState|null
     */
    public function getState(string $name): ?IState
    {
        return $this->workflowStates()->one([IState::FIELD__NAME => $name]);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasState(string $name): bool
    {
        return $this->getState($name) ? true : false;
    }
}
