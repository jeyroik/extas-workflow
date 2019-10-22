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
    protected $idAs = '';
    protected $scope = 'extas';
    protected $pk = WorkflowState::FIELD__NAME;
    protected $name = 'workflow_states';
    protected $itemClass = WorkflowState::class;
}
