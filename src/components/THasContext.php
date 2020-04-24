<?php
namespace extas\components;

use extas\interfaces\IHasContext;
use extas\interfaces\IItem;

/**
 * Trait THasContext
 *
 * @property array $config
 *
 * @package extas\components
 * @author jeyroik@gmail.com
 */
trait THasContext
{
    /**
     * @return IItem|null
     */
    public function getContext(): ?IItem
    {
        return $this->config[IHasContext::FIELD__CONTEXT] ?? null;
    }

    /**
     * @param IItem $context
     * @return $this
     */
    public function setContext(IItem $context)
    {
        $this->config[IHasContext::FIELD__CONTEXT] = $context;

        return $this;
    }
}
