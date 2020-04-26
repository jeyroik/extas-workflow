<?php
namespace extas\components\workflows\transitions;

use extas\components\Item;
use extas\components\workflows\entities\EntityContext;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\schemas\ISchema;
use extas\interfaces\workflows\schemas\transitions\ISchemaTransition;
use extas\interfaces\workflows\transitions\ITransitStorage;

/**
 * Class TransitionStorage
 *
 * @package extas\components\workflows\transitions
 * @author jeyroik@gmail.com
 */
class TransitStorage extends Item implements ITransitStorage
{
    /**
     * @return ISchema
     */
    public function getSchema(): ISchema
    {
        return $this->config[static::FIELD__SCHEMA];
    }

    /**
     * @param ISchema $schema
     * @return $this|ITransitStorage
     */
    public function setSchema(ISchema $schema): ITransitStorage
    {
        $this->config[static::FIELD__SCHEMA] = $schema;

        return $this;
    }

    /**
     * @return IEntity
     */
    public function getEntity(): IEntity
    {
        return $this->config[static::FIELD__ENTITY];
    }

    /**
     * @return EntityContext
     */
    public function getContext(): EntityContext
    {
        return $this->config[static::FIELD__CONTEXT];
    }

    /**
     * @return ISchemaTransition
     */
    public function getTransition(): ISchemaTransition
    {
        return $this->config[static::FIELD__TRANSITION];
    }

    /**
     * @param IEntity $entity
     * @return $this|ITransitStorage
     */
    public function setEntity(IEntity $entity): ITransitStorage
    {
        $this->config[static::FIELD__ENTITY] = $entity;

        return $this;
    }

    /**
     * @param EntityContext $context
     * @return $this|ITransitStorage
     */
    public function setContext(EntityContext $context): ITransitStorage
    {
        $this->config[static::FIELD__CONTEXT] = $context;

        return $this;
    }

    /**
     * @param ISchemaTransition $transition
     * @return $this|ITransitStorage
     */
    public function setTransition(ISchemaTransition $transition): ITransitStorage
    {
        $this->config[static::FIELD__TRANSITION] = $transition;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
