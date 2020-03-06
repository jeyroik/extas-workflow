<?php
namespace extas\components\workflows\transitions\errors;

use extas\interfaces\workflows\transitions\errors\ITransitionErrorVocabulary;

/**
 * Class TransitionErrorVocabulary
 *
 * @package extas\components\workflows\transitions\errors
 * @author jeyroik@gmail.com
 */
class TransitionErrorVocabulary implements ITransitionErrorVocabulary
{
    /**
     * @var array
     */
    protected static array $errors = [
        50101 => 'Not applicable entity template',
        50102 => 'Validation failed',
        50103 => 'Schema has not this transition',
        50104 => 'Can not transit entity to this state'
    ];

    /**
     * @param int $code
     *
     * @return string
     */
    public static function translate(int $code): string
    {
        return static::$errors[$code] ?? '';
    }
}
