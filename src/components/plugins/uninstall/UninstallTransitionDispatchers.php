<?php
namespace extas\components\plugins\uninstall;

use extas\components\workflows\transitions\dispatchers\TransitionDispatcher;

/**
 * Class UninstallTransitionDispatchers
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallTransitionDispatchers extends UninstallSection
{
    protected string $selfRepositoryClass = 'transitionDispatcherRepository';
    protected string $selfUID = TransitionDispatcher::FIELD__NAME;
    protected string $selfSection = 'workflow_transition_dispatchers';
    protected string $selfName = 'workflow transition dispatcher';
    protected string $selfItemClass = TransitionDispatcher::class;
}
