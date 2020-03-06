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
    protected string $selfItemClass = TransitionDispatcherTemplate::class;
    protected string $selfName = 'workflow transition dispatcher template';
    protected string $selfSection = 'workflow_transition_dispatcher_templates';
    protected string $selfUID = TransitionDispatcherTemplate::FIELD__NAME;
    protected string $selfRepositoryClass = ITransitionDispatcherTemplateRepository::class;
}
