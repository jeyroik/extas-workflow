<?php
namespace extas\interfaces\extensions\workflows;

use extas\interfaces\IItem;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\ITransition;

interface IExtensionTriggers
{
    /**
     * @return ITransitionDispatcher[]
     */
    public function getTriggers(): array;

    /**
     * @param string|ITransition $transition
     * @param IItem $context
     *
     * @return ITransitionDispatcher[]
     */
    public function getTriggersByTransition($transition, IItem $context): array;
}