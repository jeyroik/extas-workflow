<?php
namespace tests;

use extas\components\workflows\transitions\dispatchers\TransitionDispatcherExecutor;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\transits\ITransitResult;

/**
 * Class ConditionTrue
 *
 * @package tests
 * @author jeyroik@gmail.com
 */
class ConditionTrue extends TransitionDispatcherExecutor
{
    /**
     * @param ITransitResult $result
     * @param IEntity $entityEdited
     * @return bool
     */
    public function __invoke(ITransitResult &$result, IEntity &$entityEdited): bool
    {
        return true;
    }
}
