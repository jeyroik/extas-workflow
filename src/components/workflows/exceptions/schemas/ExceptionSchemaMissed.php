<?php
namespace extas\components\workflows\exceptions\schemas;

use extas\interfaces\workflows\exceptions\schemas\IExceptionSchemaMissed;
use Throwable;

/**
 * Class ExceptionSchemaMissed
 *
 * @package extas\components\workflows\exceptions\schemas
 * @author jeyroik@gmail.com
 */
class ExceptionSchemaMissed extends \Exception implements IExceptionSchemaMissed
{
    /**
     * ExceptionStateMissed constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Schema "' . $message . '" missed', $code, $previous);
    }
}
