<?php
namespace extas\components\workflows\schemas;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\schemas\ISchemaRepository;

/**
 * Class WorkflowSchemaRepository
 *
 * @package extas\components\workflows\schemas
 * @author jeyroik@gmail.com
 */
class SchemaRepository extends Repository implements ISchemaRepository
{
    protected string $idAs = '';
    protected string $scope = 'extas';
    protected string $pk = Schema::FIELD__NAME;
    protected string $name = 'workflow_schemas';
    protected string $itemClass = Schema::class;
}
