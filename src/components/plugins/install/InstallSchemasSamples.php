<?php
namespace extas\components\plugins\install;

use extas\components\workflows\schemas\SchemaSample;
use extas\interfaces\workflows\schemas\ISchemaSampleRepository;

/**
 * Class InstallSchemasSamples
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallSchemasSamples extends InstallSection
{
    protected string $selfItemClass = SchemaSample::class;
    protected string $selfName = 'workflow schema sample';
    protected string $selfSection = 'workflow_schemas_samples';
    protected string $selfUID = SchemaSample::FIELD__NAME;
    protected string $selfRepositoryClass = ISchemaSampleRepository::class;
}
