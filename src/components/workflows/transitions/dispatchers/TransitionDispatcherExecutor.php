<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\plugins\Plugin;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\samples\THasSample;
use extas\components\THasCreatedAt;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\components\THasType;
use extas\components\THasUpdatedAt;
use extas\components\workflows\transitions\THasTransition;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transits\ITransitResult;

/**
 * Class TransitionDispatcherExecutor
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
abstract class TransitionDispatcherExecutor extends TransitionDispatcher implements ITransitionDispatcherExecutor
{
     /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.transition.dispatcher.executor';
    }
}
