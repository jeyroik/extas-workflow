<?php
namespace extas\components\workflows\transitions;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\transitions\ITransitionRepository;

/**
 * Class WorkflowTransitionRepository
 *
 * @package extas\components\workflows\transitions
 * @author jeyroik@gmail.com
 */
class TransitionRepository extends Repository implements ITransitionRepository
{
    protected string $name = 'workflow_transitions';
    protected string $scope = 'extas';
    protected string $pk = Transition::FIELD__NAME;
    protected string $itemClass = Transition::class;
}
