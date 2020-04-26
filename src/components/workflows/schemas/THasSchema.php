<?php
namespace extas\components\workflows\schemas;

use extas\components\SystemContainer;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\schemas\IHasSchema;
use extas\interfaces\workflows\schemas\ISchema;
use extas\interfaces\workflows\schemas\ISchemaRepository;

/**
 * Trait THasSchema
 *
 * @property array $config
 *
 * @package extas\components\workflows\schemas
 * @author jeyroik@gmail.com
 */
trait THasSchema
{
    /**
     * @return string
     */
    public function getSchemaName(): string
    {
        return $this->config[IHasSchema::FIELD__SCHEMA_NAME] ?? '';
    }

    /**
     * @return ISchema|null
     */
    public function getSchema(): ?ISchema
    {
        /**
         * @var IRepository $repo
         */
        $repo = SystemContainer::getItem(ISchemaRepository::class);

        return $repo->one([ISchema::FIELD__NAME => $this->getSchemaName()]);
    }

    /**
     * @param string $schemaName
     * @return $this
     */
    public function setSchemaName(string $schemaName)
    {
        $this->config[IHasSchema::FIELD__SCHEMA_NAME] = $schemaName;

        return $this;
    }
}
