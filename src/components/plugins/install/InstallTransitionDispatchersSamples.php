<?php
namespace extas\components\plugins\install;

use extas\components\workflows\transitions\dispatchers\TransitionDispatcherSample;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherSampleRepository;

/**
 * Class InstallTransitionDispatchersSamples
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallTransitionDispatchersSamples extends InstallSection
{
    protected string $selfItemClass = TransitionDispatcherSample::class;
    protected string $selfName = 'workflow transition dispatcher sample';
    protected string $selfSection = 'workflow_transition_dispatchers_samples';
    protected string $selfUID = TransitionDispatcherSample::FIELD__NAME;
    protected string $selfRepositoryClass = ITransitionDispatcherSampleRepository::class;
}
