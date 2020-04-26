<?php
namespace extas\components\plugins\workflows;

use extas\components\plugins\PluginInstallDefault;
use extas\components\workflows\transitions\TransitionSample;
use extas\interfaces\workflows\transitions\ITransitionSampleRepository;

/**
 * Class PluginInstallTransitionsSamples
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallTransitionsSamples extends PluginInstallDefault
{
    protected string $selfRepositoryClass = ITransitionSampleRepository::class;
    protected string $selfUID = TransitionSample::FIELD__NAME;
    protected string $selfSection = 'workflow_transitions_samples';
    protected string $selfName = 'workflow transition sample';
    protected string $selfItemClass = TransitionSample::class;
}
