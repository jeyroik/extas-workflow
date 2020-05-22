<?php
namespace extas\components\workflows\entities;

use extas\components\workflows\exceptions\entities\ExceptionEntitySampleMissed;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\entities\IEntitySample;

/**
 * Trait THasEntity
 *
 * @property array $config
 * @method getName(): string
 * @method workflowEntityRepository()
 * @method workflowEntitySampleRepository()
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
        $entity = $this->getEntity();

        return $entity ? $entity->getName() : '';
    }

    /**
     * @return IEntity|null
     */
    public function getEntity(): ?IEntity
    {
        return $this->workflowEntityRepository()->one([IEntity::FIELD__SCHEMA_NAME => $this->getName()]);
    }

    /**
     * @param string $entitySampleName
     * @return IEntity
     * @throws ExceptionEntitySampleMissed
     */
    public function setEntity(string $entitySampleName): IEntity
    {
        $sample = $this->workflowEntitySampleRepository()->one([IEntitySample::FIELD__NAME => $entitySampleName]);

        if (!$sample) {
            throw new ExceptionEntitySampleMissed($entitySampleName);
        }

        $this->workflowEntityRepository()->delete([IEntity::FIELD__SCHEMA_NAME => $this->getName()]);
        $entity = new Entity();
        $entity->buildFromSample($sample, '@sample(uuid6)');
        $entity->setSchemaName($this->getName());

        return $this->workflowEntityRepository()->create($entity);
    }
}
