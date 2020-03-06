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
    protected string $itemClass = TransitionDispatcherTemplate::class;
    protected string $name = 'workflow_transition_dispatcher_templates';
    protected string $pk = TransitionDispatcherTemplate::FIELD__NAME;
    protected string $scope = 'extas';
    protected string $idAs = '';
}
