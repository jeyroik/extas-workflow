<?php
namespace extas\components\workflows\transitions;

use extas\components\exceptions\MissedOrUnknown;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\IItemsCollection;
use extas\interfaces\workflows\transitions\ITransition;
use extas\interfaces\workflows\transitions\ITransitionSample;

/**
 * Trait THasTransitions
 *
 * @property array $config
 *
 * @method IRepository workflowTransitions()
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
        return array_column(
            $this->workflowTransitions()->all([
                ITransition::FIELD__SCHEMA_NAME => $this->getName()
            ]),
            ITransition::FIELD__NAME
        );
    }

    /**
     * @return ITransition[]
     */
    public function getTransitions(): array
    {
        return $this->workflowTransitions()->all([
            ITransition::FIELD__SCHEMA_NAME => $this->getName()
        ]);
    }

    /**
     * @param string $transitionName
     * @return ITransition|null
     */
    public function getTransition(string $transitionName): ?ITransition
    {
        return $this->workflowTransitions()->one([
            ITransition::FIELD__SCHEMA_NAME => $this->getName(),
            ITransition::FIELD__NAME => $transitionName
        ]);
    }

    /**
     * @param string $transitionName
     * @return bool
     */
    public function hasTransition(string $transitionName): bool
    {
        return $this->getTransition($transitionName) ? true : false;
    }
}
