<?php
namespace extas\interfaces\workflows;

use extas\interfaces\IItem;
use extas\interfaces\repositories\IRepository;

/**
 * Interface IItemsCollection
 *
 * @package extas\interfaces\workflows
 * @author jeyroik@gmail.com
 */
interface IItemsCollection extends IItem
{
    public const SUBJECT = 'extas.workflow.collection';
    public const FIELD__REPOSITORY = 'repository';
    public const FIELD__REPOSITORY_QUERY = 'repository_query';

    /**
     * @return IRepository
     * @throws \Exception
     */
    public function getRepository(): IRepository;

    /**
     * @return array
     */
    public function getRepositoryQuery(): array;

    /**
     * @param IRepository $repository
     * @return IItemsCollection
     */
    public function setRepository(IRepository $repository): IItemsCollection;

    /**
     * @param array $query
     * @return IItemsCollection
     */
    public function setRepositoryQuery(array $query): IItemsCollection;

    /**
     * @return string[]
     */
    public function getItemsNames(): array;

    /**
     * @return IItem[]
     */
    public function getItems(): array;

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getItem(string $name): ?IItem;

    /**
     * @param string $itemName
     * @return bool
     */
    public function hasItem(string $itemName): bool;

    /**
     * @param array $items
     * @return IItem[]
     */
    public function addItems(array $items): array;

    /**
     * @param IItem $item
     * @return $this
     */
    public function addItem(IItem $item): IItem;

    /**
     * @param string $name
     * @return $this
     * @throws \Exception
     */
    public function removeItem(string $name): IItemsCollection;
}
