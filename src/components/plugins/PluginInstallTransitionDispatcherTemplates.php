<?php
namespace extas\components\plugins;

use extas\components\workflows\transitions\dispatchers\TransitionDispatcherTemplate;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherTemplateRepository;

/**
 * Class PluginInstallTransitionDispatcherTemplates
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallTransitionDispatcherTemplates extends PluginInstallDefault
{
    protected $selfItemClass = TransitionDispatcherTemplate::class;
    protected $selfName = 'workflow transition dispatcher template';
    protected $selfSection = 'workflow_transition_dispatcher_templates';
    protected $selfUID = TransitionDispatcherTemplate::FIELD__NAME;
    protected $selfRepositoryClass = ITransitionDispatcherTemplateRepository::class;
}
