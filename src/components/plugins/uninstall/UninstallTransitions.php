<?php
namespace extas\components\plugins\uninstall;

use extas\components\workflows\transitions\Transition;

/**
 * Class UninstallTransitions
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallTransitions extends UninstallSection
{
    protected string $selfRepositoryClass = 'transitionRepository';
    protected string $selfUID = Transition::FIELD__NAME;
    protected string $selfSection = 'workflow_transitions';
    protected string $selfName = 'workflow transition';
    protected string $selfItemClass = Transition::class;
}
