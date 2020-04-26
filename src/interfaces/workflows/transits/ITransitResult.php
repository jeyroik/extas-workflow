<?php
namespace extas\interfaces\workflows\transits;

use extas\interfaces\errors\IHasErrors;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IEntity;

/**
 * Interface ITransitionResult
 *
 * @package extas\interfaces\workflows\transitions
 * @author jeyroik@gmail.com
 */
interface ITransitResult extends IItem, IHasErrors
{
    public const SUBJECT = 'extas.workflow.transition.result';

    public const FIELD__ENTITY = 'entity';

    /**
     * @param IEntity $entity
     * @return ITransitResult
     */
    public function success(IEntity $entity): ITransitResult;

    /**
     * @return IEntity|null
     */
    public function getEntity(): ?IEntity;
}
