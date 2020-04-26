<?php
namespace extas\components\workflows\entities;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\entities\IEntityRepository;

/**
 * Class EntityRepository
 *
 * @package extas\components\workflows\entities
 * @author jeyroik@gmail.com
 */
class EntityRepository extends Repository implements IEntityRepository
{
    protected string $name = 'workflow_entities';
    protected string $scope = 'extas';
    protected string $pk = Entity::FIELD__NAME;
    protected string $itemClass = Entity::class;
}
