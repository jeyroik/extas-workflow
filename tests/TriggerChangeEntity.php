<?php
namespace tests;

use extas\components\workflows\transitions\dispatchers\TransitionDispatcherExecutor;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transitions\results\ITransitionResult;

/**
 * Class TriggerChangeEntity
 *
 * @package tests
 * @author jeyroik@gmail.com
 */
class TriggerChangeEntity extends TransitionDispatcherExecutor implements ITransitionDispatcherExecutor
{
    public const FIELD__TEST = 'test_trigger';

    /**
     * @param ITransitionResult $result
     * @param IWorkflowEntity $entityEdited
     * @return bool
     */
    public function __invoke(
        ITransitionResult &$result,
        IWorkflowEntity &$entityEdited
    ): bool
    {
        $entityEdited[static::FIELD__TEST] = 'is ok';

        return true;
    }
}