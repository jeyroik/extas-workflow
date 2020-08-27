<?php
namespace extas\components\workflows\entities;

use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\entities\IHasEntity;

/**
 * Trait THasEntity
 *
 * @property array $config
 * @method getName(): string
 * @method IRepository workflowEntities()
 *
 * @package extas\components\workflows\entities
 * @author jeyroik@gmail.com
 */
trait THasEntity
{
    /**
     * @return string
     */
    public function getEntityName(): string
    {
        return $this->config[IHasEntity::FIELD__ENTITY_NAME] ?? '';
    }

    /**
     * @return IEntity|null
     */
    public function getEntity(): ?IEntity
    {
        return $this->workflowEntities()->one([IEntity::FIELD__NAME => $this->getEntityName()]);
    }

    /**
     * @param string $entityName
     * @return $this
     */
    public function setEntityName(string $entityName)
    {
        $this->config[IHasEntity::FIELD__ENTITY_NAME] = $entityName;

        return $this;
    }
}
