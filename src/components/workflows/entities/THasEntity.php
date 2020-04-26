<?php
namespace extas\components\workflows\entities;

use extas\components\SystemContainer;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\entities\IEntityRepository;
use extas\interfaces\workflows\entities\IHasEntity;

/**
 * Trait THasEntity
 *
 * @property array $config
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
        /**
         * @var IEntityRepository $repo
         */
        $repo = SystemContainer::getItem(IEntityRepository::class);

        return $repo->one([IEntity::FIELD__NAME => $this->getEntityName()]);
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
