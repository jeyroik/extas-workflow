<?php
namespace extas\components\workflows;

use extas\components\Item;
use extas\interfaces\contexts\IContext;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\IWorkflow;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\states\IWorkflowState;

class Workflow extends Item implements IWorkflow
{
    /**
     * @param IWorkflowEntity $entity
     * @param IWorkflowState|string $toState
     * @param IWorkflowSchema $bySchema
     * @param IContext $withContext
     *
     * @return bool
     */
    public static function transit(
        IWorkflowEntity &$entity,
        $toState,
        IWorkflowSchema $bySchema,
        IContext $withContext
    ): bool
    {
        $static = new static();

        if ($bySchema->canTransit($entity->getStateName(), $toState)) {
            $toState = $toState instanceof IWorkflowState ? $toState->getName() : (string) $toState;
            $transition = $bySchema->getTransition($entity->getStateName(), $toState);
            $stage = 'workflow.transition';
            foreach ($static->getPluginsByStage($stage) as $plugin) {
                $plugin($entity, $toState, $transition, $bySchema, $withContext);
            }

            $stage = 'workflow.from.' . $entity->getStateName() . '.to.' . $toState;
            foreach ($static->getPluginsByStage($stage) as $plugin) {
                $plugin($entity, $toState, $transition, $bySchema, $withContext);
            }
            
            $stage = 'workflow.' . $transition->getName();
            foreach ($static->getPluginsByStage($stage) as $plugin) {
                $plugin($entity, $toState, $transition, $bySchema, $withContext);
            }
            $entity = $entity->setStateName($toState);

            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
