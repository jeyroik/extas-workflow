<?php
namespace tests;

use extas\components\workflows\transitions\dispatchers\TransitionDispatcherExecutor;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\transits\ITransitResult;

/**
 * Class TriggerChangeEntity
 *
 * @package tests
 * @author jeyroik@gmail.com
 */
class TriggerChangeEntity extends TransitionDispatcherExecutor
{
    public const FIELD__TEST = 'test_trigger';

    /**
     * @param ITransitResult $result
     * @param IEntity $entityEdited
     * @return bool
     */
    public function __invoke(ITransitResult &$result, IEntity &$entityEdited): bool
    {
        $entityEdited[static::FIELD__TEST] = 'is ok';

        return true;
    }
}
