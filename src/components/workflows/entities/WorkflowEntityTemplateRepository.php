<?php
namespace extas\components\workflows\entities;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\entities\IWorkflowEntityTemplateRepository;

/**
 * Class WorkflowEntityTemplateRepository
 *
 * @package extas\components\workflows\entities
 * @author jeyroik@gmail.com
 */
class WorkflowEntityTemplateRepository extends Repository implements IWorkflowEntityTemplateRepository
{
    protected $idAs = '';
    protected $scope = 'extas';
    protected $pk = WorkflowEntityTemplate::FIELD__NAME;
    protected $name = 'workflow_entity_templates';
    protected $itemClass = WorkflowEntityTemplate::class;
}
