<?php
namespace extas\interfaces\workflows\transitions\results;

use extas\interfaces\IItem;
use extas\interfaces\workflows\transitions\errors\ITransitionError;

/**
 * Interface ITransitionResult
 *
 * @package extas\interfaces\workflows\transitions\results
 * @author jeyroik@gmail.com
 */
interface ITransitionResult extends IItem
{
    const SUBJECT = 'extas.workflow.transition.result';

    const FIELD__ERROR = 'error';

    /**
     * @param int $code
     * @param array $data
     *
     * @return ITransitionResult
     */
    public function fail(int $code, array $data): ITransitionResult;

    /**
     * @return ITransitionError
     */
    public function getError(): ITransitionError;

    /**
     * @param ITransitionError $error
     *
     * @return ITransitionResult
     */
    public function setError(ITransitionError $error): ITransitionResult;

    /**
     * @return bool
     */
    public function isSuccess(): bool;
}
