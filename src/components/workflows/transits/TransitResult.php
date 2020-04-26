<?php
namespace extas\components\workflows\transits;

use extas\components\errors\THasErrors;
use extas\components\Item;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\transits\ITransitResult;

/**
 * Class TransitionResult
 *
 * @package extas\components\workflows\transits
 * @author jeyroik@gmail.com
 */
class TransitResult extends Item implements ITransitResult
{
    use THasErrors;

    /**
     * @param IEntity $entity
     * @return $this|ITransitResult
     */
    public function success(IEntity $entity): ITransitResult
    {
        $this->config[static::FIELD__ENTITY] = $entity;

        return $this;
    }

    /**
     * @return IEntity|null
     */
    public function getEntity(): ?IEntity
    {
        return $this->config[static::FIELD__ENTITY] ?? null;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
