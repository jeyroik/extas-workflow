<?php
namespace extas\components\workflows\states;

use extas\components\SystemContainer;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\states\IHasState;
use extas\interfaces\workflows\states\IState;
use extas\interfaces\workflows\states\IStateRepository;

/**
 * Trait THasState
 *
 * @property array $config
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
        /**
         * @var IRepository $repo
         */
        $repo = SystemContainer::getItem(IStateRepository::class);

        return $repo->one([IState::FIELD__NAME => $this->getStateName()]);
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
