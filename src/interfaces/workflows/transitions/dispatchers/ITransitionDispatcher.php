<?php
namespace extas\interfaces\workflows\transitions\dispatchers;

use extas\interfaces\IHasName;
use extas\interfaces\IHasType;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHasParameters;
use extas\interfaces\templates\IHasTemplate;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\transitions\IWorkflowTransition;
use extas\interfaces\workflows\transitions\results\ITransitionResult;

/**
 * Interface ITransitionDispatcher
 *
 * @package extas\interfaces\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
interface ITransitionDispatcher extends IItem, IHasParameters, IHasTemplate, IHasType, IHasName
{
    public const SUBJECT = 'extas.workflow.transition.dispatcher';

    public const FIELD__SCHEMA_NAME = 'schema_name';
    public const FIELD__TRANSITION_NAME = 'transition_name';

    public const TYPE__CONDITION = 'condition';
    public const TYPE__VALIDATOR = 'validator';
    public const TYPE__TRIGGER = 'trigger';

    public const TRANSITION__ANY = '*';

    /**
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entitySource
     * @param IWorkflowSchema $schema
     * @param IItem $context
     * @param ITransitionResult $result
     * @param IWorkflowEntity $entityEdited
     *
     * @return bool
     */
    public function dispatch(
        IWorkflowTransition $transition,
        IWorkflowEntity $entitySource,
        IWorkflowSchema $schema,
        IItem $context,
        ITransitionResult &$result,
        IWorkflowEntity &$entityEdited
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
