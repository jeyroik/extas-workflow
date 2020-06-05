<?php
namespace extas\components\plugins\install;

use extas\components\workflows\entities\EntitySample;
use extas\interfaces\workflows\entities\IEntitySampleRepository;

/**
 * Class InstallEntitiesSamples
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallEntitiesSamples extends InstallSection
{
    protected string $selfRepositoryClass = IEntitySampleRepository::class;
    protected string $selfUID = EntitySample::FIELD__NAME;
    protected string $selfSection = 'workflow_entities_samples';
    protected string $selfName = 'workflow entity sample';
    protected string $selfItemClass = EntitySample::class;
}
