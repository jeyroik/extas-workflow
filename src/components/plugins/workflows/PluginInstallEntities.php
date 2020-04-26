<?php
namespace extas\components\plugins\workflows;

use extas\components\plugins\PluginInstallDefault;
use extas\components\workflows\entities\Entity;
use extas\interfaces\packages\entities\IEntityRepository;

/**
 * Class PluginInstallEntities
 *
 * @package extas\components\plugins\workflows
 * @author jeyroik@gmail.com
 */
class PluginInstallEntities extends PluginInstallDefault
{
    protected string $selfSection = 'workflow_entities';
    protected string $selfName = 'workflow entity';
    protected string $selfRepositoryClass = IEntityRepository::class;
    protected string $selfUID = Entity::FIELD__NAME;
    protected string $selfItemClass = Entity::class;
}
