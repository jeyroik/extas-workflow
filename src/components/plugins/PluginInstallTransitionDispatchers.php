<?php
namespace extas\components\plugins;

use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
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
    protected $selfUID = ITransitionDispatcher::FIELD__ID;
    protected $selfSection = 'workflow_transition_dispatchers';
    protected $selfName = 'workflow transition dispatcher';
    protected $selfItemClass = ITransitionDispatcher::class;
}
