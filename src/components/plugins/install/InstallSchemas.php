<?php
namespace extas\components\plugins\install;

use extas\components\workflows\schemas\Schema;
use extas\interfaces\workflows\schemas\ISchemaRepository;

/**
 * Class InstallSchemas
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallSchemas extends InstallSection
{
    protected string $selfItemClass = Schema::class;
    protected string $selfName = 'workflow schema';
    protected string $selfSection = 'workflow_schemas';
    protected string $selfUID = Schema::FIELD__NAME;
    protected string $selfRepositoryClass = ISchemaRepository::class;
}
