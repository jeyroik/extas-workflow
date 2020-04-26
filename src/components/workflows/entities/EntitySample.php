<?php
namespace extas\components\workflows\entities;

use extas\components\samples\Sample;
use extas\components\THasClass;
use extas\interfaces\workflows\entities\IEntitySample;

/**
 * Class WorkflowEntityTemplate
 *
 * @package extas\components\workflows\entities
 * @author jeyroik@gmail.com
 */
class EntitySample extends Sample implements IEntitySample
{
    use THasClass;
}
