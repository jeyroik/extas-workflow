<?php
namespace tests;

use extas\components\workflows\transitions\dispatchers\TransitionDispatcherExecutor;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\transitions\results\ITransitionResult;

/**
 * Class ConditionTrue
 *
 * @package tests
 * @author jeyroik@gmail.com
 */
class ConditionTrue extends TransitionDispatcherExecutor
{
    /**
     * @param ITransitionResult $result
     * @param IWorkflowEntity $entityEdited
     * @return bool
     */
    public function __invoke(ITransitionResult &$result, IWorkflowEntity &$entityEdited): bool
    {
        return true;
    }
}
