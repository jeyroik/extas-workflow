<?php
namespace extas\components\plugins\workflows\validators;

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
 * Class ValidatorContextHasAllParams
 *
 * @package extas\components\plugins\workflows\validators
 * @author jeyroik@gmail.com
 */
class ValidatorContextHasAllParams extends Plugin implements ITransitionDispatcherExecutor
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
    ): bool
    {
        $requiredParams = $dispatcher->getParameters();

        foreach ($requiredParams as $param) {
            if (!isset($context[$param->getName()])) {
                $result->fail(ITransitionErrorVocabulary::ERROR__VALIDATION_FAILED, [
                    'context_has_all_params' => 'Missed `' . $param->getName() . '` in the current context',
                    'context' => $context->__toArray()
                ]);
                return false;
            }
        }

        return true;
    }
}
