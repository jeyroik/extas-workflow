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
    protected $idAs = '';
    protected $scope = 'extas';
    protected $pk = WorkflowSchema::FIELD__NAME;
    protected $name = 'workflow_schemas';
    protected $itemClass = WorkflowSchema::class;
}
