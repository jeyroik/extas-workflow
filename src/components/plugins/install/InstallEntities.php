<?php
namespace extas\components\plugins\install;

use extas\components\workflows\entities\Entity;
use extas\interfaces\packages\entities\IEntityRepository;

/**
 * Class InstallEntities
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallEntities extends InstallSection
{
    protected string $selfSection = 'workflow_entities';
    protected string $selfName = 'workflow entity';
    protected string $selfRepositoryClass = IEntityRepository::class;
    protected string $selfUID = Entity::FIELD__NAME;
    protected string $selfItemClass = Entity::class;
}
