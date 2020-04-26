<?php
namespace extas\components\plugins\workflows;

use extas\components\plugins\PluginInstallDefault;
use extas\components\workflows\transitions\Transition;
use extas\interfaces\workflows\transitions\ITransitionRepository;

/**
 * Class PluginInstallWorkflowTransitions
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallTransitions extends PluginInstallDefault
{
    protected string $selfRepositoryClass = ITransitionRepository::class;
    protected string $selfUID = Transition::FIELD__NAME;
    protected string $selfSection = 'workflow_transitions';
    protected string $selfName = 'workflow transition';
    protected string $selfItemClass = Transition::class;
}
