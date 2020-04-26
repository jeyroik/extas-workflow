<?php
namespace extas\components\workflows\transitions;

use extas\interfaces\workflows\transitions\IHasTransition;
use extas\components\SystemContainer;
use extas\interfaces\workflows\transitions\ITransition;
use extas\interfaces\workflows\transitions\ITransitionRepository;

/**
 * Trait THasTransition
 *
 * @property array $config
 *
 * @package extas\components\workflows\transitions
 * @author jeyroik@gmail.com
 */
trait THasTransition
{
    /**
     * @return string
     */
    public function getTransitionName(): string
    {
        return $this->config[IHasTransition::FIELD__TRANSITION_NAME] ?? '';
    }

    /**
     * @return ITransition|null
     */
    public function getTransition(): ?ITransition
    {
        /**
         * @var ITransitionRepository $repo
         */
        $repo = SystemContainer::getItem(ITransitionRepository::class);

        return $repo->one([ITransition::FIELD__NAME => $this->getTransitionName()]);
    }

    /**
     * @param string $transitionName
     * @return $this
     */
    public function setTransitionName(string $transitionName)
    {
        $this->config[IHasTransition::FIELD__TRANSITION_NAME] = $transitionName;

        return $this;
    }
}
