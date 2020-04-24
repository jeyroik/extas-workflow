<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\plugins\Plugin;
use extas\components\THasContext;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transitions\IWorkflowTransition;

/**
 * Class TransitionDispatcherExecutor
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
abstract class TransitionDispatcherExecutor extends Plugin implements ITransitionDispatcherExecutor
{
    use THasContext;

    /**
     * @return ITransitionDispatcher|null
     */
    public function getDispatcher(): ?ITransitionDispatcher
    {
        return $this->config[static::FIELD__DISPATCHER] ?? null;
    }

    /**
     * @return IWorkflowEntity|null
     */
    public function getEntitySource(): ?IWorkflowEntity
    {
        return $this->config[static::FIELD__ENTITY_SOURCE] ?? null;
    }

    /**
     * @return string
     */
    public function getSchemaName(): string
    {
        return $this->config[static::FIELD__SCHEMA_NAME] ?? '';
    }

    /**
     * @return IWorkflowTransition|null
     */
    public function getTransition(): ?IWorkflowTransition
    {
        return $this->config[static::FIELD__TRANSITION] ?? null;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.transition.dispatcher.executor';
    }
}
