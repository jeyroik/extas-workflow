<?php
namespace extas\components\workflows\entities;

use extas\components\samples\THasSample;
use extas\components\workflows\schemas\THasSchema;
use extas\components\workflows\states\THasState;
use extas\interfaces\workflows\entities\IEntity;

/**
 * Class WorkflowEntity
 *
 * @package extas\components\workflows\entities
 * @author jeyroik@gmail.com
 */
class Entity extends EntitySample implements IEntity
{
    use THasState;
    use THasSchema;
    use THasSample;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.workflow.entity';
    }
}
