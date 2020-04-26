<?php
namespace extas\components\workflows;

use extas\components\Item;
use extas\components\THasContext;
use extas\components\workflows\transits\TransitResult;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\IWorkflow;
use extas\interfaces\workflows\transitions\ITransition;
use extas\interfaces\workflows\transits\ITransitResult;

/**
 * Class Workflow
 *
 * @package extas\components\workflows
 * @author jeyroik@gmail.com
 */
class Workflow extends Item implements IWorkflow
{
    use THasContext;

    /**
     * @param IEntity $entity
     * @param ITransition $transition
     * @return ITransitResult
     */
    public function transit(IEntity $entity, ITransition $transition): ITransitResult
    {
        $result = new TransitResult();

        $conditions = $transition->getConditions();
        foreach ($conditions as $condition) {
            if (!$condition->dispatch($this->getContext(), $result, $entity)) {
                return $result;
            }
        }

        $validators = $transition->getValidators();
        foreach ($validators as $validator) {
            if (!$validator->dispatch($this->getContext(), $result, $entity)) {
                return $result;
            }
        }

        $triggers = $transition->getTriggers();
        foreach ($triggers as $trigger) {
            $trigger->dispatch($this->getContext(), $result, $entity);
        }

        return $result->success($entity);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
