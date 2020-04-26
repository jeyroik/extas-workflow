<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\samples\Sample;
use extas\components\THasClass;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherSample;

/**
 * Class TransitionDispatcherTemplate
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
class TransitionDispatcherSample extends Sample implements ITransitionDispatcherSample
{
    use THasClass;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.workflow.transition.dispatcher.sample';
    }
}
