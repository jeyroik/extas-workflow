<?php
namespace extas\interfaces\workflows\states;

use extas\interfaces\samples\IHasSample;
use extas\interfaces\workflows\schemas\IHasSchema;

/**
 * Interface IState
 *
 * @package extas\interfaces\workflows\states
 * @author jeyroik@gmail.com
 */
interface IState extends IStateSample, IHasSchema, IHasSample
{
}
