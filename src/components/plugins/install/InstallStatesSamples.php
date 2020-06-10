<?php
namespace extas\components\plugins\install;

use extas\components\workflows\states\StateSample;

/**
 * Class InstallStatesSamples
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallStatesSamples extends InstallSection
{
    protected string $selfItemClass = StateSample::class;
    protected string $selfName = 'workflow state sample';
    protected string $selfSection = 'workflow_states_samples';
    protected string $selfUID = StateSample::FIELD__NAME;
    protected string $selfRepositoryClass = 'stateSampleRepository';
}
