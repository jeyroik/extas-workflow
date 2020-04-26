<?php
namespace extas\interfaces\extensions\workflows;

use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\transitions\ITransition;

/**
 * Interface IExtensionTransitionsByState
 *
 * @package extas\interfaces\extensions\workflows
 * @author jeyroik@gmail.com
 */
interface IExtensionTransitionsByState
{
    /**
     * @param IEntity $entity
     * @param IItem $context
     *
     * @return ITransition[]
     */
    public function getAvailableTransitionsByFromState(IEntity $entity, IItem $context): array;

    /**
     * @param IEntity $entity
     * @param IItem $context
     *
     * @return ITransition[]
     */
    public function getAvailableTransitionsByToState(IEntity $entity, IItem $context): array;
}
