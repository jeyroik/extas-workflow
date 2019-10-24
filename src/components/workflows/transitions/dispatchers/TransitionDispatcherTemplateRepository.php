<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherTemplateRepository;

/**
 * Class TransitionDispatcherTemplateRepository
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
class TransitionDispatcherTemplateRepository extends Repository implements ITransitionDispatcherTemplateRepository
{
    protected $itemClass = TransitionDispatcherTemplate::class;
    protected $name = 'workflow_transition_dispatcher_templates';
    protected $pk = TransitionDispatcherTemplate::FIELD__NAME;
    protected $scope = 'extas';
    protected $idAs = '';
}
