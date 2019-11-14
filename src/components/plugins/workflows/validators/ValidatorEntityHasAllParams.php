<?php
namespace extas\components\plugins\workflows\validators;

use extas\components\plugins\Plugin;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transitions\IWorkflowTransition;

/**
 * Class ValidatorHasAllParams
 *
 * @package extas\components\plugins\workflows\validators
 * @author jeyroik@gmail.com
 */
class ValidatorEntityHasAllParams extends Plugin implements ITransitionDispatcherExecutor
{
    /**
     * @param ITransitionDispatcher $dispatcher
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entity
     * @param IWorkflowSchema $schema
     * @param IItem $context
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
        $requiredParams = $dispatcher->getParameters();

        foreach ($requiredParams as $param) {
            if (!isset($entity[$param->getName()])) {
                return false;
            }
        }

        return true;
    }
}
