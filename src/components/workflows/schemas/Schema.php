<?php
namespace extas\components\workflows\schemas;

use extas\components\samples\Sample;
use extas\components\samples\THasSample;
use extas\components\workflows\entities\THasEntity;
use extas\components\workflows\states\THasStates;
use extas\components\workflows\transitions\THasTransitions;
use extas\interfaces\workflows\schemas\ISchema;

/**
 * Class WorkflowSchema
 *
 * @package extas\components\workflows\schemas
 * @author jeyroik@gmail.com
 */
class Schema extends Sample implements ISchema
{
    use THasTransitions;
    use THasStates;
    use THasSample;
    use THasEntity;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
