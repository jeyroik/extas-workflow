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
    protected $selfRepositoryClass = IWorkflowTransitionRepository::class;
    protected $selfUID = WorkflowTransition::FIELD__NAME;
    protected $selfSection = 'workflow_transitions';
    protected $selfName = 'workflow transition';
    protected $selfItemClass = WorkflowTransition::class;
}
