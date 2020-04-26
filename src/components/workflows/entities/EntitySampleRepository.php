<?php
namespace extas\components\workflows\entities;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\entities\IEntitySampleRepository;

/**
 * Class WorkflowEntityTemplateRepository
 *
 * @package extas\components\workflows\entities
 * @author jeyroik@gmail.com
 */
class EntitySampleRepository extends Repository implements IEntitySampleRepository
{
    protected string $scope = 'extas';
    protected string $pk = EntitySample::FIELD__NAME;
    protected string $name = 'workflow_entities_samples';
    protected string $itemClass = EntitySample::class;
}
