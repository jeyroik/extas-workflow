<?php
namespace extas\components\plugins\install;

use extas\components\workflows\transitions\TransitionSample;
use extas\interfaces\workflows\transitions\ITransitionSampleRepository;

/**
 * Class InstallTransitionsSamples
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallTransitionsSamples extends InstallSection
{
    protected string $selfRepositoryClass = ITransitionSampleRepository::class;
    protected string $selfUID = TransitionSample::FIELD__NAME;
    protected string $selfSection = 'workflow_transitions_samples';
    protected string $selfName = 'workflow transition sample';
    protected string $selfItemClass = TransitionSample::class;
}
