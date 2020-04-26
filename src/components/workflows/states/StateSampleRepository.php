<?php
namespace extas\components\workflows\states;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\states\IStateRepository;

/**
 * Class StateSampleRepository
 *
 * @package extas\components\workflows\states
 * @author jeyroik@gmail.com
 */
class StateSampleRepository extends Repository implements IStateRepository
{
    protected string $name = 'workflow_states_samples';
    protected string $scope = 'extas';
    protected string $pk = StateSample::FIELD__NAME;
    protected string $itemClass = StateSample::class;
}
