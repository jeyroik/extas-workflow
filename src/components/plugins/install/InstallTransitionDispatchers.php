<?php
namespace extas\components\plugins\install;

use extas\components\workflows\transitions\dispatchers\TransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherRepository;

/**
 * Class InstallTransitionDispatchers
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallTransitionDispatchers extends InstallSection
{
    protected string $selfRepositoryClass = ITransitionDispatcherRepository::class;
    protected string $selfUID = TransitionDispatcher::FIELD__NAME;
    protected string $selfSection = 'workflow_transition_dispatchers';
    protected string $selfName = 'workflow transition dispatcher';
    protected string $selfItemClass = TransitionDispatcher::class;
}
