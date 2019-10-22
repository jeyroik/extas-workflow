<?php
namespace extas\components\workflows\transitions;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\transitions\IWorkflowTransitionRepository;

/**
 * Class WorkflowTransitionRepository
 *
 * @package extas\components\workflows\transitions
 * @author jeyroik@gmail.com
 */
class WorkflowTransitionRepository extends Repository implements IWorkflowTransitionRepository
{
    protected $itemClass = WorkflowTransition::class;
    protected $name = 'workflow_transitions';
    protected $pk = WorkflowTransition::FIELD__NAME;
    protected $scope = 'extas';
    protected $idAs = '';
}
