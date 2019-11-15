<?php
namespace extas\interfaces\workflows\transitions\errors;

use extas\interfaces\IItem;

/**
 * Interface ITransitionError
 *
 * @package extas\interfaces\workflows\transitions\errors
 * @author jeyroik@gmail.com
 */
interface ITransitionError extends IItem
{
    const SUBJECT = 'extas.workflow.transition.error';

    const FIELD__MESSAGE = 'message';
    const FIELD__CODE = 'code';
    const FIELD__DATA = 'data';

    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @return int
     */
    public function getCode(): int;

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @param string $message
     *
     * @return ITransitionError
     */
    public function setMessage(string $message): ITransitionError;

    /**
     * @param int $code
     *
     * @return ITransitionError
     */
    public function setCode(int $code): ITransitionError;

    /**
     * @param array $data
     *
     * @return ITransitionError
     */
    public function setData(array $data): ITransitionError;
}
