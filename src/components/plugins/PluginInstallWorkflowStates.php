<?php
namespace extas\components\plugins;

use extas\components\workflows\states\WorkflowState;
use extas\interfaces\workflows\states\IWorkflowStateRepository;

/**
 * Class PluginInstallWorkflowStates
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallWorkflowStates extends PluginInstallDefault
{
    protected string $selfItemClass = WorkflowState::class;
    protected string $selfName = 'workflow state';
    protected string $selfSection = 'workflow_states';
    protected string $selfUID = WorkflowState::FIELD__NAME;
    protected string $selfRepositoryClass = IWorkflowStateRepository::class;
}
