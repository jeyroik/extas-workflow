<?php
namespace extas\interfaces\workflows\schemas;

/**
 * Interface IHasSchema
 *
 * @package extas\interfaces\workflows\schemas
 * @author jeyroik@gmail.com
 */
interface IHasSchema
{
    public const FIELD__SCHEMA_NAME = 'schema_name';

    /**
     * @return string
     */
    public function getSchemaName(): string;

    /**
     * @return ISchema|null
     */
    public function getSchema(): ?ISchema;

    /**
     * @param string $schemaName
     * @return $this
     */
    public function setSchemaName(string $schemaName);
}
