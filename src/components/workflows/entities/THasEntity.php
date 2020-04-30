<?php
namespace extas\components\workflows\entities;

use extas\components\SystemContainer;
use extas\components\workflows\exceptions\entities\ExceptionEntitySampleMissed;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\entities\IEntityRepository;
use extas\interfaces\workflows\entities\IEntitySample;
use extas\interfaces\workflows\entities\IEntitySampleRepository;

/**
 * Trait THasEntity
 *
 * @property array $config
 * @method getName(): string
 *
 * @package extas\components\workflows\entities
 * @author jeyroik@gmail.com
 */
trait THasEntity
{
    protected ?IRepository $entityRepo = null;

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
        return $this->getEntityRepository()->one([IEntity::FIELD__SCHEMA_NAME => $this->getName()]);
    }

    /**
     * @param string $entitySampleName
     * @return IEntity
     * @throws ExceptionEntitySampleMissed
     */
    public function setEntity(string $entitySampleName)
    {
        /**
         * @var $sampleRepo IEntitySampleRepository
         */
        $sampleRepo = SystemContainer::getItem(IEntitySampleRepository::class);
        $sample = $sampleRepo->one([IEntitySample::FIELD__NAME => $entitySampleName]);

        if (!$sample) {
            throw new ExceptionEntitySampleMissed($entitySampleName);
        }

        $this->entityRepo->delete([IEntity::FIELD__SCHEMA_NAME => $this->getName()]);
        $entity = new Entity();
        $entity->buildFromSample($sample, '@sample(uuid6)');
        $entity->setSchemaName($this->getName());

        return $this->getEntityRepository()->create($entity);
    }

    /**
     * @return IRepository
     */
    protected function getEntityRepository()
    {
        return $this->entityRepo ?: $this->entityRepo = SystemContainer::getItem(IEntityRepository::class);
    }
}
