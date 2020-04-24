<?php
namespace extas\interfaces\workflows\transitions\dispatchers;

use extas\interfaces\IHasContext;
use extas\interfaces\IItem;
use extas\interfaces\plugins\IPlugin;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\transitions\IWorkflowTransition;
use extas\interfaces\workflows\transitions\results\ITransitionResult;

/**
 * Interface ITransitionDispatcherExecutor
 *
 * @package extas\interfaces\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
interface ITransitionDispatcherExecutor extends IPlugin, IHasContext
{
    public const SUBJECT = 'extas.transition.dispatcher.executor';

    public const FIELD__DISPATCHER = 'dispatcher';
    public const FIELD__TRANSITION = 'transition';
    public const FIELD__ENTITY_SOURCE = 'entity_source';
    public const FIELD__SCHEMA_NAME = 'schema_name';

    /**
     * @param ITransitionResult $result
     * @param IWorkflowEntity $entityEdited
     *
     * @return bool
     */
    public function __invoke(ITransitionResult &$result, IWorkflowEntity &$entityEdited): bool;

    /**
     * @return ITransitionDispatcher|null
     */
    public function getDispatcher(): ?ITransitionDispatcher;

    /**
     * @return IWorkflowTransition|null
     */
    public function getTransition(): ?IWorkflowTransition;

    /**
     * @return IWorkflowEntity
     */
    public function getEntitySource(): ?IWorkflowEntity;

    /**
     * @return string
     */
    public function getSchemaName(): string;
}
