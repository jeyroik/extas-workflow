<?php
namespace extas\components\plugins\uninstall;

use extas\components\workflows\schemas\Schema;

/**
 * Class UninstallSchemas
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallSchemas extends UninstallSection
{
    protected string $selfItemClass = Schema::class;
    protected string $selfName = 'workflow schema';
    protected string $selfSection = 'workflow_schemas';
    protected string $selfUID = Schema::FIELD__NAME;
    protected string $selfRepositoryClass = 'schemaRepository';
}
