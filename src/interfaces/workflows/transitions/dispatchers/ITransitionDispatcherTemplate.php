<?php
namespace extas\interfaces\workflows\transitions\dispatchers;

use extas\interfaces\IHasClass;
use extas\interfaces\IHasType;
use extas\interfaces\templates\ITemplate;

/**
 * Interface ITransitionDispatcherTemplate
 *
 * @package extas\interfaces\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
interface ITransitionDispatcherTemplate extends ITemplate, IHasClass, IHasType
{
    const SUBJECT = 'extas.workflow.transition.dispatcher.template';
}
