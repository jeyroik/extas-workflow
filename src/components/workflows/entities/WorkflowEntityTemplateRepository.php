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
    protected string $idAs = '';
    protected string $scope = 'extas';
    protected string $pk = WorkflowEntityTemplate::FIELD__NAME;
    protected string $name = 'workflow_entity_templates';
    protected string $itemClass = WorkflowEntityTemplate::class;
}
