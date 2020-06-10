<?php
namespace extas\components\plugins\uninstall;

use extas\components\workflows\schemas\SchemaSample;

/**
 * Class UninstallSchemasSamples
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallSchemasSamples extends UninstallSection
{
    protected string $selfItemClass = SchemaSample::class;
    protected string $selfName = 'workflow schema sample';
    protected string $selfSection = 'workflow_schemas_samples';
    protected string $selfUID = SchemaSample::FIELD__NAME;
    protected string $selfRepositoryClass = 'schemaSampleRepository';
}
