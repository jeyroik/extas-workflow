<?php
namespace extas\components\workflows;

use extas\interfaces\IHasName;
use extas\interfaces\IItem;

/**
 * Trait THasItems
 *
 * @property array $config
 *
 * @package extas\components\workflows
 * @author jeyroik@gmail.com
 */
trait THasItems
{
    /**
     * @param string $fieldName
     * @return string[]
     */
    public function getItemsNames(string $fieldName): array
    {
        return $this->config[$fieldName] ?? [];
    }

    /**
     * @param string $repoMethod
     * @param string $fieldName
     *
     * @return array
     */
    public function getItems(string $repoMethod, string $fieldName): array
    {
        return $this->$repoMethod()->all([IHasName::FIELD__NAME => $this->getItemsNames($fieldName)]);
    }

    /**
     * @param string $repoMethod
     * @param string $fieldName
     * @param string $name
     * @return mixed|null
     */
    public function getItem(string $repoMethod, string $fieldName, string $name): ?IItem
    {
        if ($this->hasItemName($fieldName, $name)) {
            return $this->$repoMethod()->one([IHasName::FIELD__NAME => $name]);
        }

        return null;
    }

    /**
     * @param string $fieldName
     * @param string $itemName
     * @return bool
     */
    public function hasItemName(string $fieldName, string $itemName): bool
    {
        return in_array($itemName, $this->getItemsNames($fieldName));
    }

    /**
     * @param string $fieldName
     * @param array $names
     * @return $this
     */
    public function setItemsNames(string $fieldName, array $names)
    {
        $this->config[$fieldName] = $names;

        return $this;
    }

    /**
     * @param string $fieldName
     * @param string $name
     * @return $this
     */
    public function addItemName(string $fieldName, string $name)
    {
        if (!$this->hasItemName($fieldName, $name)) {
            $items = $this->getItemsNames($fieldName);
            $items[] = $name;
            $this->setItemsNames($fieldName, $items);
        }

        return $this;
    }

    /**
     * @param string $fieldName
     * @param string $exceptionClass
     * @param string $name
     * @return $this
     * @throws \Exception
     */
    public function removeItemName(string $fieldName, string $exceptionClass, string $name)
    {
        if ($this->hasItemName($fieldName, $name)) {
            $items = array_flip($this->getItemsNames($fieldName));
            unset($items[$name]);
            $this->setItemsNames($fieldName, array_keys($items));

            return $this;
        }

        throw new $exceptionClass($name);
    }
}
