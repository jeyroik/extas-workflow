<?php
namespace extas\components\workflows\states;

use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\states\IHasState;
use extas\interfaces\workflows\states\IState;

/**
 * Trait THasState
 *
 * @property array $config
 * @method IRepository workflowStates()
 *
 * @package extas\components\workflows\states
 * @author jeyroik@gmail.com
 */
trait THasState
{
    /**
     * @return string
     */
    public function getStateName(): string
    {
        return $this->config[IHasState::FIELD__STATE_NAME] ?? '';
    }

    /**
     * @return IState|null
     */
    public function getState(): ?IState
    {
        return $this->workflowStates()->one([IState::FIELD__NAME => $this->getStateName()]);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setStateName(string $name)
    {
        $this->config[IHasState::FIELD__STATE_NAME] = $name;

        return $this;
    }
}
