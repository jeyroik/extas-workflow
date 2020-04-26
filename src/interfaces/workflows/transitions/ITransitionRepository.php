<?php
namespace extas\interfaces\workflows\transitions;

use extas\interfaces\IItem;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\entities\IEntity;

/**
 * Interface ITransitionRepository
 *
 * @package extas\interfaces\workflows\transitions
 * @author jeyroik@gmail.com
 */
interface ITransitionRepository extends IRepository
{
    /**
     * @param $where
     * @param int $limit
     * @param int $offset
     * @param array $orderBy
     * @param array $fields
     * @return array
     * @throws \Exception
     */
    public function allByNames($where, int $limit = 0, int $offset = 0, array $orderBy = [], array $fields = []): array;

    /**
     * @param array $conditionQuery
     * @param IItem $context
     * @param IEntity $entity
     * @return ITransition[]
     */
    public function filterTransitionByConditions(array $conditionQuery, IItem $context, IEntity $entity): array;
}
