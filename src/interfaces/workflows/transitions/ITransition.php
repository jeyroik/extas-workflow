<?php
namespace extas\interfaces\workflows\transitions;

use extas\interfaces\samples\IHasSample;
use extas\interfaces\workflows\schemas\IHasSchema;
use extas\interfaces\workflows\transitions\dispatchers\IHasDispatchers;

/**
 * Interface ITransition
 *
 * @package extas\interfaces\workflows\transitions
 * @author jeyroik@gmail.com
 */
interface ITransition extends ITransitionSample, IHasSchema, IHasDispatchers, IHasSample
{
}
