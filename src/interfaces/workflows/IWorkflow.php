<?php
namespace extas\interfaces\workflows;

use extas\interfaces\IHasContext;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\transitions\ITransition;
use extas\interfaces\workflows\transits\ITransitResult;

/**
 * Interface IWorkflow
 *
 * @package extas\interfaces\workflows
 * @author jeyroik@gmail.com
 */
interface IWorkflow extends IItem, IHasContext
{
    public const SUBJECT = 'extas.workflow';

    /**
     * @param IEntity $entity
     * @param ITransition $transition
     * @return ITransitResult
     */
    public function transit(IEntity $entity, ITransition $transition): ITransitResult;
}
