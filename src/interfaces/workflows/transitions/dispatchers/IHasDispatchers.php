<?php
namespace extas\interfaces\workflows\transitions\dispatchers;

use extas\interfaces\workflows\exceptions\transitions\dispatchers\IExceptionDispatcherMissed;

/**
 * Interface IHasDispatchers
 *
 * @package extas\interfaces\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
interface IHasDispatchers
{
    /**
     * @return ITransitionDispatcher[]
     */
    public function getConditions(): array;

    /**
     * @return ITransitionDispatcher[]
     */
    public function getValidators(): array;

    /**
     * @return ITransitionDispatcher[]
     */
    public function getTriggers(): array;
}
