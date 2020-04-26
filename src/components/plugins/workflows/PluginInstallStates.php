<?php
namespace extas\components\plugins\workflows;

use extas\components\plugins\PluginInstallDefault;
use extas\components\workflows\states\State;
use extas\interfaces\workflows\states\IStateRepository;

/**
 * Class PluginInstallWorkflowStates
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallStates extends PluginInstallDefault
{
    protected string $selfItemClass = State::class;
    protected string $selfName = 'workflow state';
    protected string $selfSection = 'workflow_states';
    protected string $selfUID = State::FIELD__NAME;
    protected string $selfRepositoryClass = IStateRepository::class;
}
