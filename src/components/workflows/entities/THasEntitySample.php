<?php
namespace extas\components\workflows\entities;

use extas\interfaces\workflows\entities\IEntitySample;
use extas\interfaces\workflows\entities\IHasEntitySample;

/**
 * Trait THasEntitySample
 *
 * @property array $config
 * @method workflowEntitySampleRepository()
 *
 * @package extas\components\workflows\entities
 * @author jeyroik@gmail.com
 */
trait THasEntitySample
{
    /**
     * @return string
     */
    public function getEntitySampleName(): string
    {
        return $this->config[IHasEntitySample::FIELD__ENTITY_SAMPLE_NAME] ?? '';
    }

    /**
     * @return IEntitySample|null
     */
    public function getEntitySample(): ?IEntitySample
    {
        return $this->workflowEntitySampleRepository()->one([
            IEntitySample::FIELD__NAME => $this->getEntitySampleName()
        ]);
    }

    /**
     * @param string $entitySampleName
     * @return $this
     */
    public function setEntitySampleName(string $entitySampleName)
    {
        $this->config[IHasEntitySample::FIELD__ENTITY_SAMPLE_NAME] = $entitySampleName;

        return $this;
    }
}
