<?php
namespace extas\components\plugins\install;

use extas\components\workflows\transitions\dispatchers\TransitionDispatcher;

/**
 * Class InstallTransitionDispatchers
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallTransitionDispatchers extends InstallSection
{
    protected string $selfRepositoryClass = 'transitionDispatcherRepository';
    protected string $selfUID = TransitionDispatcher::FIELD__NAME;
    protected string $selfSection = 'workflow_transition_dispatchers';
    protected string $selfName = 'workflow transition dispatcher';
    protected string $selfItemClass = TransitionDispatcher::class;
}
