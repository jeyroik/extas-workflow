<?php
namespace extas\components\workflows\exceptions\transitions;

use extas\interfaces\workflows\exceptions\transitions\IExceptionTransitionMissed;
use Throwable;

/**
 * Class ExceptionTransitionMissed
 *
 * @package extas\components\workflows\exceptions\transitions
 * @author jeyroik@gmail.com
 */
class ExceptionTransitionMissed extends \Exception implements IExceptionTransitionMissed
{
    /**
     * ExceptionStateMissed constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Transition "' . $message . '" missed', $code, $previous);
    }
}
