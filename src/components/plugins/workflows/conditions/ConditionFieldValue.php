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
 * Class ConditionFieldValue
 *
 * @package extas\components\plugins\workflows\conditions
 * @author jeyroik@gmail.com
 */
class ConditionFieldValue extends Plugin implements ITransitionDispatcherExecutor
{
    /**
     * @param ITransitionDispatcher $dispatcher
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entitySource
     * @param IWorkflowSchema $schema
     * @param IItem $context
     * @param ITransitionResult $result
     * @param IWorkflowEntity $entityEdited
     *
     * @return bool
     */
    public function __invoke(
        ITransitionDispatcher $dispatcher,
        IWorkflowTransition $transition,
        IWorkflowEntity $entitySource,
        IWorkflowSchema $schema,
        IItem $context,
        ITransitionResult &$result,
        IWorkflowEntity &$entityEdited
    )
    {
        $fieldName = $dispatcher->getParameter('field_name');
        if (!$fieldName) {
            $result->fail(ITransitionErrorVocabulary::ERROR__VALIDATION_FAILED, [
                'field_value' => 'Missed `field_name` parameter in the dispatcher "' . $dispatcher->getName() . '"'
            ]);
            return false;
        }

        $fieldValue = $dispatcher->getParameter('field_value');

        if (!$fieldValue) {
            $result->fail(ITransitionErrorVocabulary::ERROR__VALIDATION_FAILED, [
                'field_value' => 'Missed `field_value` parameter in the dispatcher "' . $dispatcher->getName() . '"'
            ]);
            return false;
        }

        $entityValue = isset($entity[$fieldName->getValue()]) ? $entitySource[$fieldName->getValue()] : null;
        $equal = ($entityValue == $fieldValue->getValue());

        if (!$equal) {
            $result->fail(ITransitionErrorVocabulary::ERROR__VALIDATION_FAILED, [
                'field_value' => '`' . $fieldName->getValue() . '` is not equal to `' . $fieldValue->getValue() . '`'
            ]);
        }

        return $equal;
    }
}
