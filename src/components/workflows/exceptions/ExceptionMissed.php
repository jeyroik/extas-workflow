<?php
namespace extas\components\workflows\exceptions;

use Throwable;

/**
 * Class ExceptionMissed
 *
 * @package extas\components\workflows\exceptions
 * @author jeyroik@gmail.com
 */
class ExceptionMissed extends \Exception
{
    protected string $missedName = '';

    /**
     * ExceptionStateMissed constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($this->missedName . ' "' . $message . '" missed', $code, $previous);
    }
}
