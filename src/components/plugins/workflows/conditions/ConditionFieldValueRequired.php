<?php
namespace extas\components\plugins\workflows\conditions;

use extas\components\plugins\Plugin;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transitions\errors\ITransitionErrorVocabulary;
use extas\interfaces\workflows\transitions\IWorkflowTransition;
use extas\interfaces\workflows\transitions\results\ITransitionResult;

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
     * @param ITransitionResult $result
     *
     * @return bool
     */
    public function __invoke(
        ITransitionDispatcher $dispatcher,
        IWorkflowTransition $transition,
        IWorkflowEntity $entity,
        IWorkflowSchema $schema,
        IItem $context,
        ITransitionResult &$result
    )
    {
        $fieldName = $dispatcher->getParameter('field_name');
        if (!$fieldName) {
            $result->fail(ITransitionErrorVocabulary::ERROR__VALIDATION_FAILED, [
                'field_value_required' => 'Missed `field_name` parameter in the `' . $dispatcher->getName() . '`'
            ]);
            return false;
        }

        $fieldValue = isset($entity[$fieldName->getValue()]) ? $entity[$fieldName->getValue()] : null;
        $valid = empty($fieldValue) ? false : true;

        if (!$valid) {
            $result->fail(ITransitionErrorVocabulary::ERROR__VALIDATION_FAILED, [
                'field_value_required' => 'Missed required field `' . $fieldName->getValue() . '`'
            ]);
        }

        return $valid;
    }
}
