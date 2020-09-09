<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;

/**
 * Trait THasDispatchers
 *
 * @property array $config
 * @method IRepository workflowTransitionsDispatchers()
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
trait THasDispatchers
{
    /**
     * @return ITransitionDispatcher[]
     */
    public function getConditions(): array
    {
        return $this->getDispatchers(ITransitionDispatcher::TYPE__CONDITION);
    }

    /**
     * @return ITransitionDispatcher[]
     */
    public function getValidators(): array
    {
        return $this->getDispatchers(ITransitionDispatcher::TYPE__VALIDATOR);
    }

    /**
     * @return ITransitionDispatcher[]
     */
    public function getTriggers(): array
    {
        return $this->getDispatchers(ITransitionDispatcher::TYPE__TRIGGER);
    }

    /**
     * @param array $names
     * @param string $type
     * @return array
     */
    protected function getDispatchers(string $type)
    {
        return $this->workflowTransitionsDispatchers()->all(
            [
                ITransitionDispatcher::FIELD__TRANSITION_NAME => $this->getName(),
                ITransitionDispatcher::FIELD__TYPE => $type
            ],
            0,
            0,
            [ITransitionDispatcher::FIELD__PRIORITY, -1]
        );
    }
}
