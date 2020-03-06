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
    protected string $itemClass = WorkflowTransition::class;
    protected string $name = 'workflow_transitions';
    protected string $pk = WorkflowTransition::FIELD__NAME;
    protected string $scope = 'extas';
    protected string $idAs = '';
}
