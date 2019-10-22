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
    protected $selfItemClass = WorkflowState::class;
    protected $selfName = 'workflow state';
    protected $selfSection = 'workflow_states';
    protected $selfUID = WorkflowState::FIELD__NAME;
    protected $selfRepositoryClass = IWorkflowStateRepository::class;
}
