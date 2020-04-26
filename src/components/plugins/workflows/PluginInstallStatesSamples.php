<?php
namespace extas\components\plugins\workflows;

use extas\components\plugins\PluginInstallDefault;
use extas\components\workflows\states\StateSample;
use extas\interfaces\workflows\states\IStateSampleRepository;

/**
 * Class PluginInstallStatesSamples
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallStatesSamples extends PluginInstallDefault
{
    protected string $selfItemClass = StateSample::class;
    protected string $selfName = 'workflow state sample';
    protected string $selfSection = 'workflow_states_samples';
    protected string $selfUID = StateSample::FIELD__NAME;
    protected string $selfRepositoryClass = IStateSampleRepository::class;
}
