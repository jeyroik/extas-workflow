<?php
namespace extas\interfaces\workflows\transitions\errors;

/**
 * Interface ITransitionErrorVocabulary
 *
 * @package extas\interfaces\workflows\transitions\errors
 * @author jeyroik@gmail.com
 */
interface ITransitionErrorVocabulary
{
    const ERROR__NOT_APPLICABLE_ENTITY_TEMPLATE = 50101;
    const ERROR__VALIDATION_FAILED = 50102;
    const ERROR__UNKNOWN_TRANSITION = 50103;
    const ERROR__CAN_NOT_TRANSIT_TO_STATE = 50104;

    /**
     * @param int $code
     *
     * @return string
     */
    public static function translate(int $code): string;
}
