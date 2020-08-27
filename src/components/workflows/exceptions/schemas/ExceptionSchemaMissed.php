<?php
namespace extas\components\workflows\exceptions\schemas;

use extas\components\workflows\exceptions\ExceptionMissed;
use extas\interfaces\workflows\exceptions\schemas\IExceptionSchemaMissed;

/**
 * Class ExceptionSchemaMissed
 *
 * @package extas\components\workflows\exceptions\schemas
 * @author jeyroik@gmail.com
 */
class ExceptionSchemaMissed extends ExceptionMissed implements IExceptionSchemaMissed
{
    protected string $missedName = 'schema';
}
