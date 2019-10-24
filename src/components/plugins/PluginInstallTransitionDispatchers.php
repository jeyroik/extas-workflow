<?php
namespace extas\components\plugins;

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
    protected $selfRepositoryClass = ITransitionDispatcherRepository::class;
    protected $selfUID = TransitionDispatcher::FIELD__ID;
    protected $selfSection = 'workflow_transition_dispatchers';
    protected $selfName = 'workflow transition dispatcher';
    protected $selfItemClass = TransitionDispatcher::class;
}
