<?php
namespace extas\components\plugins\uninstall;

use extas\components\workflows\states\StateSample;

/**
 * Class UninstallStatesSamples
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallStatesSamples extends UninstallSection
{
    protected string $selfItemClass = StateSample::class;
    protected string $selfName = 'workflow state sample';
    protected string $selfSection = 'workflow_states_samples';
    protected string $selfUID = StateSample::FIELD__NAME;
    protected string $selfRepositoryClass = 'stateSampleRepository';
}
