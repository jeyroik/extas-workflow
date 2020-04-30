<?php
namespace extas\components\workflows\exceptions\entities;

use extas\components\workflows\exceptions\ExceptionMissed;
use extas\interfaces\workflows\exceptions\entities\IExceptionEntitySampleMissed;

/**
 * Class ExceptionEntitySampleMissed
 *
 * @package extas\components\workflows\exceptions\entities
 * @author jeyroik@gmail.com
 */
class ExceptionEntitySampleMissed extends ExceptionMissed implements IExceptionEntitySampleMissed
{
    protected string $missedName = 'Entity sample';
}
