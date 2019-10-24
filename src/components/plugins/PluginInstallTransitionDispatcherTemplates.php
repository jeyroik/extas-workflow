<?php
namespace extas\components\plugins;

use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherTemplate;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherTemplateRepository;

/**
 * Class PluginInstallTransitionDispatcherTemplates
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallTransitionDispatcherTemplates extends PluginInstallDefault
{
    protected $selfItemClass = ITransitionDispatcherTemplate::class;
    protected $selfName = 'workflow transition dispatcher template';
    protected $selfSection = 'workflow_transition_dispatcher_templates';
    protected $selfUID = ITransitionDispatcherTemplate::FIELD__NAME;
    protected $selfRepositoryClass = ITransitionDispatcherTemplateRepository::class;
}
