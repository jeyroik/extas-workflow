<?php
namespace extas\components\workflows\transitions;

use extas\components\repositories\Repository;
use extas\components\SystemContainer;
use extas\components\workflows\transits\TransitResult;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherRepository;
use extas\interfaces\workflows\transitions\ITransition;
use extas\interfaces\workflows\transitions\ITransitionRepository;

/**
 * Class WorkflowTransitionRepository
 *
 * @package extas\components\workflows\transitions
 * @author jeyroik@gmail.com
 */
class TransitionRepository extends Repository implements ITransitionRepository
{
    protected string $itemClass = Transition::class;
    protected string $name = 'workflow_transitions';
    protected string $pk = Transition::FIELD__NAME;
    protected string $scope = 'extas';
    protected string $idAs = '';

    /**
     * @param $where
     * @param int $limit
     * @param int $offset
     * @param array $orderBy
     * @param array $fields
     * @return array
     * @throws \Exception
     */
    public function allByNames($where, int $limit = 0, int $offset = 0, array $orderBy = [], array $fields = []): array
    {
        /**
         * @var ITransition[] $all
         */
        $all = parent::all($where, $limit, $offset, $orderBy, $fields);
        $byName = [];
        foreach ($all as $item) {
            $byName[$item->getName()] = $item;
        }

        return $byName;
    }

    /**
     * @param array $conditionQuery
     * @param IItem $context
     * @param IEntity $entity
     * @return ITransition[]
     * @throws \Exception
     */
    public function filterTransitionByConditions(array $conditionQuery, IItem $context, IEntity $entity): array
    {
        $transitionNames = $this->allByNames($conditionQuery);
        /**
         * @var ITransitionDispatcherRepository $dispatcherRepo
         * @var ITransitionDispatcher[] $conditions
         */
        $dispatcherRepo = SystemContainer::getItem(ITransitionDispatcherRepository::class);

        $conditions = $dispatcherRepo->all([
            ITransitionDispatcher::FIELD__TYPE => ITransitionDispatcher::TYPE__CONDITION,
            ITransitionDispatcher::FIELD__TRANSITION_NAME => array_keys($transitionNames)
        ]);

        $result = new TransitResult();

        foreach ($conditions as $condition) {
            $condition->setContext($context);
            $transition = $transitionNames[$condition->getTransitionName()];
            if (!$condition->dispatch($transition, $entity, $result, $entity)) {
                unset($transitionNames[$condition->getTransitionName()]);
            }
        }

        return array_values($transitionNames);
    }
}
