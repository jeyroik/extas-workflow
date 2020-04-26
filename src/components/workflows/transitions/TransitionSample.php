<?php
namespace extas\components\workflows\transitions;

use extas\components\samples\Sample;
use extas\components\SystemContainer;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\states\IState;
use extas\interfaces\workflows\states\IStateRepository;
use extas\interfaces\workflows\transitions\ITransitionSample;

/**
 * Class TransitionSample
 *
 * @package extas\components\workflows\transitions
 * @author jeyroik@gmail.com
 */
class TransitionSample extends Sample implements ITransitionSample
{
    /**
     * @return string
     */
    public function getStateFromName(): string
    {
        return $this->config[static::FIELD__STATE_FROM] ?? '';
    }

    /**
     * @return IState|null
     */
    public function getStateFrom(): ?IState
    {
        return $this->getState($this->getStateFromName());
    }

    /**
     * @return string
     */
    public function getStateToName(): string
    {
        return $this->config[static::FIELD__STATE_TO] ?? '';
    }

    /**
     * @return IState|null
     */
    public function getStateTo(): ?IState
    {
        return $this->getState($this->getStateToName());
    }

    /**
     * @param string $stateName
     * @return $this|ITransitionSample
     */
    public function setStateFromName(string $stateName): ITransitionSample
    {
        $this->config[static::FIELD__STATE_FROM] = $stateName;

        return $this;
    }

    /**
     * @param string $stateName
     * @return $this|ITransitionSample
     */
    public function setStateToName(string $stateName): ITransitionSample
    {
        $this->config[static::FIELD__STATE_TO] = $stateName;

        return $this;
    }

    /**
     * @param string $name
     * @return IState|null
     */
    protected function getState(string $name): ?IState
    {
        /**
         * @var IRepository $repo
         */
        $repo = SystemContainer::getItem(IStateRepository::class);

        return $repo->one([IState::FIELD__NAME => $name]);
    }
}
