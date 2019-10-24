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
    protected $idAs = TransitionDispatcher::FIELD__ID;
    protected $scope = 'extas';
    protected $pk = TransitionDispatcher::FIELD__ID;
    protected $name = 'workflow_transition_dispatchers';
    protected $itemClass = TransitionDispatcher::class;
}
