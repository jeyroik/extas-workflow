<?php
namespace extas\interfaces\workflows\entities;

use extas\interfaces\samples\IHasSample;
use extas\interfaces\workflows\schemas\IHasSchema;
use extas\interfaces\workflows\states\IHasState;

/**
 * Interface IWorkflowEntity
 *
 * @package extas\interfaces\workflows\entities
 * @author jeyroik@gmail.com
 */
interface IEntity extends IEntitySample, IHasSchema, IHasState, IHasSample
{
}
