<?php
namespace extas\components\workflows\schemas;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\schemas\IWorkflowSchemaRepository;

/**
 * Class WorkflowSchemaRepository
 *
 * @package extas\components\workflows\schemas
 * @author jeyroik@gmail.com
 */
class WorkflowSchemaRepository extends Repository implements IWorkflowSchemaRepository
{
    protected string $idAs = '';
    protected string $scope = 'extas';
    protected string $pk = WorkflowSchema::FIELD__NAME;
    protected string $name = 'workflow_schemas';
    protected string $itemClass = WorkflowSchema::class;
}
