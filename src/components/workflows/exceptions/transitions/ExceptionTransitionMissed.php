<?php
namespace extas\components\workflows\exceptions\transitions;

use extas\components\workflows\exceptions\ExceptionMissed;
use extas\interfaces\workflows\exceptions\transitions\IExceptionTransitionMissed;

/**
 * Class ExceptionTransitionMissed
 *
 * @package extas\components\workflows\exceptions\transitions
 * @author jeyroik@gmail.com
 */
class ExceptionTransitionMissed extends ExceptionMissed implements IExceptionTransitionMissed
{
    protected string $missedName = 'transition';
}
