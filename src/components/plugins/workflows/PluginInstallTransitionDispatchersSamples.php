<?php
namespace extas\components\plugins\workflows;

use extas\components\plugins\PluginInstallDefault;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcherSample;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherSampleRepository;

/**
 * Class PluginInstallTransitionDispatcherTemplates
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallTransitionDispatchersSamples extends PluginInstallDefault
{
    protected string $selfItemClass = TransitionDispatcherSample::class;
    protected string $selfName = 'workflow transition dispatcher sample';
    protected string $selfSection = 'workflow_transition_dispatcher_samples';
    protected string $selfUID = TransitionDispatcherSample::FIELD__NAME;
    protected string $selfRepositoryClass = ITransitionDispatcherSampleRepository::class;
}
