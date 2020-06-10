<?php
namespace extas\components\plugins\uninstall;

use extas\components\workflows\states\State;

/**
 * Class UninstallStates
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallStates extends UninstallSection
{
    protected string $selfItemClass = State::class;
    protected string $selfName = 'workflow state';
    protected string $selfSection = 'workflow_states';
    protected string $selfUID = State::FIELD__NAME;
    protected string $selfRepositoryClass = 'stateRepository';
}
