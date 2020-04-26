<?php
namespace extas\components\plugins\workflows;

use extas\components\plugins\PluginInstallDefault;
use extas\components\workflows\entities\EntitySample;
use extas\interfaces\workflows\entities\IEntitySampleRepository;

/**
 * Class PluginInstallWorkflowEntityTemplates
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallEntitiesSamples extends PluginInstallDefault
{
    protected string $selfRepositoryClass = IEntitySampleRepository::class;
    protected string $selfUID = EntitySample::FIELD__NAME;
    protected string $selfSection = 'workflow_entities_samples';
    protected string $selfName = 'workflow entity sample';
    protected string $selfItemClass = EntitySample::class;
}
