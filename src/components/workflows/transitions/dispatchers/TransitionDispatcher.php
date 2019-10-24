<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\Item;
use extas\components\parameters\THasParameters;
use extas\components\SystemContainer;
use extas\components\templates\THasTemplate;
use extas\components\THasName;
use extas\components\THasType;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherTemplate;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherTemplateRepository;
use extas\interfaces\workflows\transitions\IWorkflowTransition;

/**
 * Class TransitionDispatcher
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
class TransitionDispatcher extends Item implements ITransitionDispatcher
{
    use THasParameters;
    use THasTemplate;
    use THasType;
    use THasName;

    /**
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entity
     * @param IWorkflowSchema $schema
     * @param IItem $context
     *
     * @return bool
     */
    public function dispatch(
        IWorkflowTransition $transition,
        IWorkflowEntity $entity,
        IWorkflowSchema $schema,
        IItem $context
    ): bool
    {
        /**
         * @var $template ITransitionDispatcherTemplate
         */
        $template = $this->getTemplate();
        $executor = $template->buildClassWithParameters();

        return $executor($this, $transition, $entity, $schema, $context);
    }

    /**
     * @return string
     */
    public function getSchemaName(): string
    {
        return $this->config[static::FIELD__SCHEMA_NAME] ?? '';
    }

    /**
     * @return string
     */
    public function getTransitionName(): string
    {
        return $this->config[static::FIELD__TRANSITION_NAME] ?? '';
    }

    /**
     * @param string $schemaName
     *
     * @return ITransitionDispatcher
     */
    public function setSchemaName(string $schemaName): ITransitionDispatcher
    {
        $this->config[static::FIELD__SCHEMA_NAME] = $schemaName;

        return $this;
    }

    /**
     * @param string $transitionName
     *
     * @return ITransitionDispatcher
     */
    public function setTransitionName(string $transitionName): ITransitionDispatcher
    {
        $this->config[static::FIELD__TRANSITION_NAME] = $transitionName;

        return $this;
    }

    /**
     * @return \extas\interfaces\repositories\IRepository|mixed
     */
    public function getTemplateRepository()
    {
        return SystemContainer::getItem(ITransitionDispatcherTemplateRepository::class);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}