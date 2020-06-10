<?php
namespace extas\components\plugins\uninstall;

use extas\components\workflows\transitions\dispatchers\TransitionDispatcherSample;

/**
 * Class UninstallTransitionDispatchersSamples
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallTransitionDispatchersSamples extends UninstallSection
{
    protected string $selfItemClass = TransitionDispatcherSample::class;
    protected string $selfName = 'workflow transition dispatcher sample';
    protected string $selfSection = 'workflow_transition_dispatchers_samples';
    protected string $selfUID = TransitionDispatcherSample::FIELD__NAME;
    protected string $selfRepositoryClass = 'transitionDispatcherSampleRepository';
}
