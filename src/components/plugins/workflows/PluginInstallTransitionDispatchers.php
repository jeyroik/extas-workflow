<?php
namespace extas\components\plugins\workflows;

use extas\components\plugins\PluginInstallDefault;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherRepository;

/**
 * Class PluginInstallTransitionDispatchers
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallTransitionDispatchers extends PluginInstallDefault
{
    protected string $selfRepositoryClass = ITransitionDispatcherRepository::class;
    protected string $selfUID = TransitionDispatcher::FIELD__NAME;
    protected string $selfSection = 'workflow_transition_dispatchers';
    protected string $selfName = 'workflow transition dispatcher';
    protected string $selfItemClass = TransitionDispatcher::class;
}
