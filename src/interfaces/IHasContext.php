<?php
namespace extas\interfaces;

/**
 * Interface IHasContext
 *
 * @package extas\interfaces
 * @author jeyroik@gmail.com
 */
interface IHasContext
{
    public const FIELD__CONTEXT = 'context';

    /**
     * @return IItem|null
     */
    public function getContext(): ?IItem;

    /**
     * @param IItem $context
     * @return $this
     */
    public function setContext(IItem $context);
}
