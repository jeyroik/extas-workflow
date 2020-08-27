<?php
namespace extas\interfaces\workflows\entities;

/**
 * Interface IHasEntity
 *
 * @package extas\interfaces\workflows\entities
 * @author jeyroik@gmail.com
 */
interface IHasEntity
{
    public const FIELD__ENTITY_NAME = 'entity';

    /**
     * @return string
     */
    public function getEntityName(): string;

    /**
     * @return IEntity|null
     */
    public function getEntity(): ?IEntity;

    /**
     * @param string $entityName
     * @return $this
     */
    public function setEntityName(string $entityName);
}
