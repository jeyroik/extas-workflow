<?php
namespace extas\components\plugins;

use extas\components\workflows\entities\WorkflowEntityTemplate;
use extas\interfaces\workflows\entities\IWorkflowEntityTemplateRepository;

/**
 * Class PluginInstallWorkflowEntityTemplates
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallWorkflowEntityTemplates extends PluginInstallDefault
{
    protected string $selfRepositoryClass = IWorkflowEntityTemplateRepository::class;
    protected string $selfUID = WorkflowEntityTemplate::FIELD__NAME;
    protected string $selfSection = 'workflow_entity_templates';
    protected string $selfName = 'workflow entity template';
    protected string $selfItemClass = WorkflowEntityTemplate::class;
}
