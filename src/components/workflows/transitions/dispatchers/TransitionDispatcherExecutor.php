<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\THasContext;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;

/**
 * Class TransitionDispatcherExecutor
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
abstract class TransitionDispatcherExecutor extends TransitionDispatcher implements ITransitionDispatcherExecutor
{
    use THasContext;

     /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.transition.dispatcher.executor';
    }
}
