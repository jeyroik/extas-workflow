<?php
namespace extas\components\workflows\transitions\errors;

use extas\components\Item;
use extas\interfaces\workflows\transitions\errors\ITransitionError;

/**
 * Class TransitionError
 *
 * @package extas\components\workflows\transitions\errors
 * @author jeyroik@gmail.com
 */
class TransitionError extends Item implements ITransitionError
{
    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->config[static::FIELD__MESSAGE] ?? '';
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->config[static::FIELD__CODE] ?? 0;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->config[static::FIELD__DATA] ?? [];
    }

    /**
     * @param string $message
     *
     * @return ITransitionError
     */
    public function setMessage(string $message): ITransitionError
    {
        $this->config[static::FIELD__MESSAGE] = $message;

        return $this;
    }

    /**
     * @param int $code
     *
     * @return ITransitionError
     */
    public function setCode(int $code): ITransitionError
    {
        $this->config[static::FIELD__CODE] = $code;

        return $this;
    }

    /**
     * @param array $data
     *
     * @return ITransitionError
     */
    public function setData(array $data): ITransitionError
    {
        $this->config[static::FIELD__DATA] = $data;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
