<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherSampleRepository;

/**
 * Class TransitionDispatcherTemplateRepository
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
class TransitionDispatcherSampleRepository extends Repository implements ITransitionDispatcherSampleRepository
{
    protected string $itemClass = TransitionDispatcherSample::class;
    protected string $name = 'workflow_transition_dispatcher_samples';
    protected string $pk = TransitionDispatcherSample::FIELD__NAME;
    protected string $scope = 'extas';
}
