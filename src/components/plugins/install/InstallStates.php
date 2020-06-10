<?php
namespace extas\components\plugins\install;

use extas\components\workflows\states\State;

/**
 * Class InstallStates
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallStates extends InstallSection
{
    protected string $selfItemClass = State::class;
    protected string $selfName = 'workflow state';
    protected string $selfSection = 'workflow_states';
    protected string $selfUID = State::FIELD__NAME;
    protected string $selfRepositoryClass = 'stateRepository';
}
