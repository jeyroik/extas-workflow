<?php
namespace extas\components\workflows\exceptions\transitions\dispatchers;

use extas\components\workflows\exceptions\ExceptionMissed;
use extas\interfaces\workflows\exceptions\transitions\dispatchers\IExceptionDispatcherMissed;

/**
 * Class ExceptionDispatcherMissed
 *
 * @package extas\components\workflows\exceptions\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
class ExceptionDispatcherMissed extends ExceptionMissed implements IExceptionDispatcherMissed
{
    protected string $missedName = 'transition dispatcher';
}
