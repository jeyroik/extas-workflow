<?php
namespace tests;

use extas\components\errors\Error;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcherExecutor;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\transits\ITransitResult;

/**
 * Class ConditionFalse
 *
 * @package tests
 * @author jeyroik@gmail.com
 */
class ConditionFalse extends TransitionDispatcherExecutor
{
    /**
     * @param ITransitResult $result
     * @param IEntity $entityEdited
     * @return bool
     */
    public function __invoke(ITransitResult &$result, IEntity &$entityEdited): bool
    {
        $result->addError(new Error([
            Error::FIELD__CODE => 500,
            Error::FIELD__NAME => 'server_error'
        ]));

        return false;
    }
}
