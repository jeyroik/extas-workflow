<?php
namespace extas\components\plugins\workflows\triggers;

use extas\components\plugins\Plugin;
use extas\interfaces\contexts\IContext;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transitions\IWorkflowTransition;

/**
 * Class TriggerHelloWorld
 *
 * @package extas\components\plugins\workflows\triggers
 * @author jeyroik@gmail.com
 */
class TriggerHelloWorld extends Plugin implements ITransitionDispatcherExecutor
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
        $map = [
            'ru' => 'Привет мир',
            'en' => 'Hello world'
        ];

        $lang = isset($context['lang']) ? $context['lang'] : 'en';

        echo $map[$lang] ?? $map['en'];

        return true;
    }
}
