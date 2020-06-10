<?php
namespace extas\components\plugins\install;

use extas\components\workflows\transitions\Transition;

/**
 * Class InstallTransitions
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallTransitions extends InstallSection
{
    protected string $selfRepositoryClass = 'transitionRepository';
    protected string $selfUID = Transition::FIELD__NAME;
    protected string $selfSection = 'workflow_transitions';
    protected string $selfName = 'workflow transition';
    protected string $selfItemClass = Transition::class;
}
