<?php
namespace extas\components\plugins\uninstall;

use extas\components\workflows\entities\Entity;

/**
 * Class UninstallEntities
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallEntities extends UninstallSection
{
    protected string $selfSection = 'workflow_entities';
    protected string $selfName = 'workflow entity';
    protected string $selfRepositoryClass = 'entityRepository';
    protected string $selfUID = Entity::FIELD__NAME;
    protected string $selfItemClass = Entity::class;
}
