<?php
namespace extas\components\plugins\workflows;

use extas\components\plugins\PluginInstallDefault;
use extas\components\workflows\schemas\SchemaSample;
use extas\interfaces\workflows\schemas\ISchemaSampleRepository;

/**
 * Class PluginInstallSchemasSamples
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallSchemasSamples extends PluginInstallDefault
{
    protected string $selfItemClass = SchemaSample::class;
    protected string $selfName = 'workflow schema sample';
    protected string $selfSection = 'workflow_schemas_samples';
    protected string $selfUID = SchemaSample::FIELD__NAME;
    protected string $selfRepositoryClass = ISchemaSampleRepository::class;
}
