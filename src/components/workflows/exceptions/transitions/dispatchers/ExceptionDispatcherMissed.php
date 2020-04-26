<?php
namespace extas\components\workflows\exceptions\transitions\dispatchers;

use extas\interfaces\workflows\exceptions\transitions\dispatchers\IExceptionDispatcherMissed;
use Throwable;

/**
 * Class ExceptionDispatcherMissed
 *
 * @package extas\components\workflows\exceptions\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
class ExceptionDispatcherMissed extends \Exception implements IExceptionDispatcherMissed
{
    /**
     * ExceptionStateMissed constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Transition dispatcher "' . $message . '" missed', $code, $previous);
    }
}
