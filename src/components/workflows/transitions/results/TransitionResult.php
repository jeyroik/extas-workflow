<?php
namespace extas\components\workflows\transitions\results;

use extas\components\Item;
use extas\components\workflows\transitions\errors\TransitionError;
use extas\components\workflows\transitions\errors\TransitionErrorVocabulary;
use extas\interfaces\workflows\transitions\errors\ITransitionError;
use extas\interfaces\workflows\transitions\results\ITransitionResult;

/**
 * Class TransitionResult
 *
 * @package extas\components\workflows\transitions\results
 * @author jeyroik@gmail.com
 */
class TransitionResult extends Item implements ITransitionResult
{
    /**
     * @param int $code
     * @param array $data
     *
     * @return ITransitionResult
     */
    public function fail(int $code, array $data): ITransitionResult
    {
        return $this->setError(new TransitionError([
            TransitionError::FIELD__CODE => $code,
            TransitionError::FIELD__MESSAGE => TransitionErrorVocabulary::translate($code),
            TransitionError::FIELD__DATA => $data
        ]));
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return empty($this->config[static::FIELD__ERROR]);
    }

    /**
     * @return ITransitionError
     */
    public function getError(): ITransitionError
    {
        return $this->config[static::FIELD__ERROR] ?? new TransitionError();
    }

    /**
     * @param ITransitionError $error
     *
     * @return ITransitionResult
     */
    public function setError(ITransitionError $error): ITransitionResult
    {
        $this->config[static::FIELD__ERROR] = $error;

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
