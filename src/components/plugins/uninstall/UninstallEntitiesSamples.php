<?php
namespace extas\components\plugins\uninstall;

use extas\components\workflows\entities\EntitySample;

/**
 * Class UninstallEntitiesSamples
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallEntitiesSamples extends UninstallSection
{
    protected string $selfRepositoryClass = 'entitySampleRepository';
    protected string $selfUID = EntitySample::FIELD__NAME;
    protected string $selfSection = 'workflow_entities_samples';
    protected string $selfName = 'workflow entity sample';
    protected string $selfItemClass = EntitySample::class;
}
