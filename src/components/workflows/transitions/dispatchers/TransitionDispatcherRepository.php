<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherRepository;

/**
 * Class TransitionDispatcherRepository
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
class TransitionDispatcherRepository extends Repository implements ITransitionDispatcherRepository
{
    protected string $idAs = '';
    protected string $scope = 'extas';
    protected string $pk = TransitionDispatcher::FIELD__NAME;
    protected string $name = 'workflow_transition_dispatchers';
    protected string $itemClass = TransitionDispatcher::class;
}
