<?php
namespace extas\components\plugins\workflows\conditions;

use extas\components\plugins\Plugin;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transitions\IWorkflowTransition;

/**
 * Class ConditionFieldValueRequired
 *
 * @package extas\components\plugins\workflows\conditions
 * @author jeyroik@gmail.com
 */
class ConditionFieldValueRequired extends Plugin implements ITransitionDispatcherExecutor
{
    /**
     * @param ITransitionDispatcher $dispatcher
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entity
     * @param IWorkflowSchema $schema
     * @param IItem $context
     *
     * @return bool
     */
    public function __invoke(
        ITransitionDispatcher $dispatcher,
        IWorkflowTransition $transition,
        IWorkflowEntity $entity,
        IWorkflowSchema $schema,
        IItem $context
    )
    {
        $fieldName = $dispatcher->getParameter('field_name');
        if (!$fieldName) {
            return false;
        }

        $fieldValue = isset($entity[$fieldName->getValue()]) ? $entity[$fieldName->getValue()] : null;

        return empty($fieldValue) ? false : true;
    }
}
