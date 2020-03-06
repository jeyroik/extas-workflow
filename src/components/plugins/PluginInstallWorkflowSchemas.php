<?php
namespace extas\components\plugins;

use extas\components\workflows\schemas\WorkflowSchema;
use extas\interfaces\workflows\schemas\IWorkflowSchemaRepository;

/**
 * Class PluginInstallWorkflowSchemas
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallWorkflowSchemas extends PluginInstallDefault
{
    protected string $selfItemClass = WorkflowSchema::class;
    protected string $selfName = 'workflow schema';
    protected string $selfSection = 'workflow_schemas';
    protected string $selfUID = WorkflowSchema::FIELD__NAME;
    protected string $selfRepositoryClass = IWorkflowSchemaRepository::class;
}
