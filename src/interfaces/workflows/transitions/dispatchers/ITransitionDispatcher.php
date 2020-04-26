<?php
namespace extas\interfaces\workflows\transitions\dispatchers;

use extas\interfaces\IHasPriority;
use extas\interfaces\IHasType;
use extas\interfaces\IItem;
use extas\interfaces\samples\IHasSample;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\transitions\IHasTransition;
use extas\interfaces\workflows\transits\ITransitResult;

/**
 * Interface ITransitionDispatcher
 *
 * @package extas\interfaces\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
interface ITransitionDispatcher extends
    ITransitionDispatcherSample,
    IHasTransition,
    IHasPriority,
    IHasType,
    IHasSample
{
    public const TYPE__CONDITION = 'condition';
    public const TYPE__VALIDATOR = 'validator';
    public const TYPE__TRIGGER = 'trigger';

    public const TRANSITION__ANY = '*';

    /**
     * @param IItem $context
     * @param ITransitResult $result
     * @param IEntity $entityEdited
     *
     * @return bool
     */
    public function dispatch(IItem $context, ITransitResult &$result, IEntity &$entityEdited): bool;
}
