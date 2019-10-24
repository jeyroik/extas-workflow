<?php
namespace extas\interfaces\workflows\transitions\dispatchers;

use extas\interfaces\contexts\IContext;
use extas\interfaces\IHasId;
use extas\interfaces\IHasType;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHasParameters;
use extas\interfaces\templates\IHasTemplate;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\transitions\IWorkflowTransition;

/**
 * Interface ITransitionDispatcher
 *
 * @package extas\interfaces\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
interface ITransitionDispatcher extends IItem, IHasId, IHasParameters, IHasTemplate, IHasType
{
    const SUBJECT = 'extas.workflow.transition.dispatcher';

    const FIELD__SCHEMA_NAME = 'schema_name';
    const FIELD__TRANSITION_NAME = 'transition_name';

    const TYPE__VALIDATOR = 'validator';
    const TYPE__TRIGGER = 'trigger';

    /**
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entity
     * @param IWorkflowSchema $schema
     * @param IContext $context
     *
     * @return bool
     */
    public function dispatch(
        IWorkflowTransition $transition,
        IWorkflowEntity $entity,
        IWorkflowSchema $schema,
        IContext $context
    ): bool;

    /**
     * @return string
     */
    public function getSchemaName(): string;

    /**
     * @return string
     */
    public function getTransitionName(): string;

    /**
     * @param string $schemaName
     *
     * @return ITransitionDispatcher
     */
    public function setSchemaName(string $schemaName): ITransitionDispatcher;

    /**
     * @param string $transitionName
     *
     * @return ITransitionDispatcher
     */
    public function setTransitionName(string $transitionName): ITransitionDispatcher;
}
