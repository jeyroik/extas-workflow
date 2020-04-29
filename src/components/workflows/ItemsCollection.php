<?php
namespace extas\components\workflows;

use extas\components\Item;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\IItemsCollection;

/**
 * Class ItemsCollection
 *
 * @package extas\components\workflows
 * @author jeyroik@gmail.com
 */
class ItemsCollection extends Item implements IItemsCollection
{
    /**
     * @return IRepository
     * @throws \Exception
     */
    public function getRepository(): IRepository
    {
        $repo = $this->config[static::FIELD__REPOSITORY] ?? null;

        if (!$repo) {
            throw new \Exception('Missed repository');
        }

        return $repo;
    }

    /**
     * @return array
     */
    public function getRepositoryQuery(): array
    {
        return $this->config[static::FIELD__REPOSITORY_QUERY] ?? [];
    }

    /**
     * @param IRepository $repository
     * @return $this|IItemsCollection
     */
    public function setRepository(IRepository $repository): IItemsCollection
    {
        $this->config[static::FIELD__REPOSITORY] = $repository;

        return $this;
    }

    /**
     * @param array $query
     * @return $this|IItemsCollection
     */
    public function setRepositoryQuery(array $query): IItemsCollection
    {
        $this->config[static::FIELD__REPOSITORY_QUERY] = $query;

        return $this;
    }

    /**
     * @return array
     * @throws
     */
    public function getItems(): array
    {
        return $this->getRepository()->all($this->getRepositoryQuery());
    }

    /**
     * @param string $name
     * @return IItem|null
     * @throws
     */
    public function getItem(string $name): ?IItem
    {
        $query = $this->getRepositoryQuery();
        $query[IHasName::FIELD__NAME] = $name;

        return $this->getRepository()->one($query);
    }

    /**
     * @param string $itemName
     * @return bool
     * @throws
     */
    public function hasItem(string $itemName): bool
    {
        return $this->getItem($itemName) ? true : false;
    }

    /**
     * @return array
     */
    public function getItemsNames(): array
    {
        $items = $this->getItems();
        return array_column($items, IHasName::FIELD__NAME);
    }

    /**
     * @param array $items
     * @return IItem[]
     * @throws
     */
    public function addItems(array $items): array
    {
        $repo = $this->getRepository();
        $createdItems = [];
        foreach ($items as $item) {
            $createdItems[] = $repo->create($item);
        }

        return $createdItems;
    }

    /**
     * @param IItem $item
     * @return IItem
     * @throws
     */
    public function addItem(IItem $item): IItem
    {
        return $this->getRepository()->create($item);
    }

    /**
     * @param string $name
     * @return $this|IItemsCollection
     * @throws
     */
    public function removeItem(string $name): IItemsCollection
    {
        if (!$this->hasItem($name)) {
            throw new \Exception('Missed item "' . $name . '"');
        }

        $this->getRepository()->delete([IHasName::FIELD__NAME => $name]);

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
