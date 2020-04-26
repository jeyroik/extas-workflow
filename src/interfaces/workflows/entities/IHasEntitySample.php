<?php
namespace extas\interfaces\workflows\entities;

/**
 * Interface IHasEntitySample
 *
 * @package extas\interfaces\workflows\entities
 * @author jeyroik@gmail.com
 */
interface IHasEntitySample
{
    public const FIELD__ENTITY_SAMPLE_NAME = 'entity_sample';

    /**
     * @return string
     */
    public function getEntitySampleName(): string;

    /**
     * @return IEntitySample|null
     */
    public function getEntitySample(): ?IEntitySample;

    /**
     * @param string $entitySampleName
     * @return $this
     */
    public function setEntitySampleName(string $entitySampleName);
}