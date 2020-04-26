<?php
namespace extas\components\workflows\states;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\states\IStateRepository;

/**
 * Class WorkflowStateRepository
 *
 * @package extas\components\workflows\states
 * @author jeyroik@gmail.com
 */
class StateRepository extends Repository implements IStateRepository
{
    protected string $idAs = '';
    protected string $scope = 'extas';
    protected string $pk = State::FIELD__NAME;
    protected string $name = 'workflow_states';
    protected string $itemClass = State::class;
}
