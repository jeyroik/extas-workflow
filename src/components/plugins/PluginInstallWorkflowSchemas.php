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
    protected $selfItemClass = WorkflowSchema::class;
    protected $selfName = 'workflow schema';
    protected $selfSection = 'workflow_schemas';
    protected $selfUID = WorkflowSchema::FIELD__NAME;
    protected $selfRepositoryClass = IWorkflowSchemaRepository::class;
}
