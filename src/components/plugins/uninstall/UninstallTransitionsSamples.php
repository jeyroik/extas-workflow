<?php
namespace extas\components\plugins\uninstall;

use extas\components\workflows\transitions\TransitionSample;

/**
 * Class UninstallTransitionsSamples
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallTransitionsSamples extends UninstallSection
{
    protected string $selfRepositoryClass = 'transitionSampleRepository';
    protected string $selfUID = TransitionSample::FIELD__NAME;
    protected string $selfSection = 'workflow_transitions_samples';
    protected string $selfName = 'workflow transition sample';
    protected string $selfItemClass = TransitionSample::class;
}
