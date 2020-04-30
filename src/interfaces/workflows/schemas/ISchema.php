<?php
namespace extas\interfaces\workflows\schemas;

use extas\interfaces\samples\IHasSample;
use extas\interfaces\samples\ISample;
use extas\interfaces\workflows\entities\IHasEntity;
use extas\interfaces\workflows\states\IHasStates;
use extas\interfaces\workflows\transitions\IHasTransitions;

/**
 * Interface IWorkflowSchema
 *
 * @package extas\interfaces\workflows\schemas
 * @author jeyroik@gmail.com
 */
interface ISchema extends ISample, IHasEntity, IHasSample, IHasTransitions, IHasStates
{
}
