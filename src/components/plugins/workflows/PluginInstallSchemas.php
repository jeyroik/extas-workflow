<?php
namespace extas\components\plugins\workflows;

use extas\components\plugins\PluginInstallDefault;
use extas\components\workflows\schemas\Schema;
use extas\interfaces\workflows\schemas\ISchemaRepository;

/**
 * Class PluginInstallWorkflowSchemas
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallSchemas extends PluginInstallDefault
{
    protected string $selfItemClass = Schema::class;
    protected string $selfName = 'workflow schema';
    protected string $selfSection = 'workflow_schemas';
    protected string $selfUID = Schema::FIELD__NAME;
    protected string $selfRepositoryClass = ISchemaRepository::class;
}
