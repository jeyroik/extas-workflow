<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\templates\Template;
use extas\components\THasClass;
use extas\components\THasType;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherTemplate;

/**
 * Class TransitionDispatcherTemplate
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
class TransitionDispatcherTemplate extends Template implements ITransitionDispatcherTemplate
{
    use THasClass;
    use THasType;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.workflow.transition.dispatcher.template';
    }
}
