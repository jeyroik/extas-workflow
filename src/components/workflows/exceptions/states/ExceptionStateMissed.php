<?php
namespace extas\components\workflows\exceptions\states;

use extas\components\workflows\exceptions\ExceptionMissed;
use extas\interfaces\workflows\exceptions\states\IExceptionStateMissed;

/**
 * Class ExceptionStateMissed
 *
 * @package extas\components\workflows\exceptions\states
 * @author jeyroik@gmail.com
 */
class ExceptionStateMissed extends ExceptionMissed implements IExceptionStateMissed
{
    protected string $missedName = 'State';
}
