<?php
namespace extas\components\plugins\workflows\validators;

use extas\components\plugins\Plugin;
use extas\interfaces\contexts\IContext;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transitions\IWorkflowTransition;

/**
 * Class ValidatorHelloWorld
 *
 * @package extas\components\plugins\workflows\validators
 * @author jeyroik@gmail.com
 */
class ValidatorHelloWorld extends Plugin implements ITransitionDispatcherExecutor
{
    /**
     * @param ITransitionDispatcher $dispatcher
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entity
     * @param IWorkflowSchema $schema
     * @param IContext $context
     *
     * @return bool
     */
    public function __invoke(
        ITransitionDispatcher $dispatcher,
        IWorkflowTransition $transition,
        IWorkflowEntity $entity,
        IWorkflowSchema $schema,
        IContext $context
    )
    {
        if (!isset($context['name'])) {
            echo 'Missed "name" in a context';
            return false;
        }

        if ($context['name'] != $dispatcher->getParameter('name')->getValue('')) {
            echo 'Incorrect name in a context';
            return false;
        }

        return true;
    }
}
