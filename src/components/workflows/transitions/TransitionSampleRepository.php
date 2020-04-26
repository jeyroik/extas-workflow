<?php
namespace extas\components\workflows\transitions;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\transitions\ITransitionSampleRepository;

/**
 * Class TransitionSampleRepository
 *
 * @package extas\components\workflows\transitions
 * @author jeyroik@gmail.com
 */
class TransitionSampleRepository extends Repository implements ITransitionSampleRepository
{
    protected string $name = 'workflow_transitions_samples';
    protected string $scope = 'extas';
    protected string $pk = TransitionSample::FIELD__NAME;
    protected string $itemClass = TransitionSample::class;
}
