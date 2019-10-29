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
    protected $selfRepositoryClass = IWorkflowEntityTemplateRepository::class;
    protected $selfUID = WorkflowEntityTemplate::FIELD__NAME;
    protected $selfSection = 'workflow_entity_templates';
    protected $selfName = 'workflow entity template';
    protected $selfItemClass = WorkflowEntityTemplate::class;
}
