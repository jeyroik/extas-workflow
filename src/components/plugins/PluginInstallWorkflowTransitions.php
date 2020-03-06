<?php
namespace extas\components\plugins;

use extas\components\workflows\transitions\WorkflowTransition;
use extas\interfaces\workflows\transitions\IWorkflowTransitionRepository;

/**
 * Class PluginInstallWorkflowTransitions
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallWorkflowTransitions extends PluginInstallDefault
{
    protected string $selfRepositoryClass = IWorkflowTransitionRepository::class;
    protected string $selfUID = WorkflowTransition::FIELD__NAME;
    protected string $selfSection = 'workflow_transitions';
    protected string $selfName = 'workflow transition';
    protected string $selfItemClass = WorkflowTransition::class;
}
