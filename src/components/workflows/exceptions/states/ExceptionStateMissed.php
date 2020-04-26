<?php
namespace extas\components\workflows\exceptions\states;

use extas\interfaces\workflows\exceptions\states\IExceptionStateMissed;
use Throwable;

/**
 * Class ExceptionStateMissed
 *
 * @package extas\components\workflows\exceptions\states
 * @author jeyroik@gmail.com
 */
class ExceptionStateMissed extends \Exception implements IExceptionStateMissed
{
    /**
     * ExceptionStateMissed constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('State "' . $message . '" missed', $code, $previous);
    }
}
