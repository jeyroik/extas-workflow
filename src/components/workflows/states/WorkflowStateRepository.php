<?php
namespace extas\components\workflows\states;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\states\IWorkflowStateRepository;

/**
 * Class WorkflowStateRepository
 *
 * @package extas\components\workflows\states
 * @author jeyroik@gmail.com
 */
class WorkflowStateRepository extends Repository implements IWorkflowStateRepository
{
    protected string $idAs = '';
    protected string $scope = 'extas';
    protected string $pk = WorkflowState::FIELD__NAME;
    protected string $name = 'workflow_states';
    protected string $itemClass = WorkflowState::class;
}
