<?php
namespace extas\components\workflows\schemas;

use extas\components\repositories\Repository;
use extas\interfaces\workflows\schemas\ISchemaSampleRepository;

/**
 * Class SchemaSampleRepository
 *
 * @package extas\components\workflows\schemas
 * @author jeyroik@gmail.com
 */
class SchemaSampleRepository extends Repository implements ISchemaSampleRepository
{
    protected string $name = 'workflow_schemas_samples';
    protected string $scope = 'extas';
    protected string $pk = SchemaSample::FIELD__NAME;
    protected string $itemClass = SchemaSample::class;
}
