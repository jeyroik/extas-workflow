<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\Item;
use extas\components\parameters\THasParameters;
use extas\components\SystemContainer;
use extas\components\templates\THasTemplate;
use extas\components\THasContext;
use extas\components\THasName;
use extas\components\THasPriority;
use extas\components\THasType;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherTemplate;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherTemplateRepository;
use extas\interfaces\workflows\transitions\IWorkflowTransition;
use extas\interfaces\workflows\transitions\results\ITransitionResult;
use extas\interfaces\repositories\IRepository;

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
    use THasContext;
    use THasPriority;

    /**
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entitySource
     * @param ITransitionResult $result
     * @param IWorkflowEntity $entityEdited
     *
     * @return bool
     */
    public function dispatch(
        IWorkflowTransition $transition,
        IWorkflowEntity $entitySource,
        ITransitionResult &$result,
        IWorkflowEntity &$entityEdited
    ): bool
    {
        /**
         * @var ITransitionDispatcherTemplate $template
         * @var ITransitionDispatcherExecutor $executor
         */
        $template = $this->getTemplate();
        $executor = $template->buildClassWithParameters([
            ITransitionDispatcherExecutor::FIELD__SCHEMA_NAME => $this->getSchemaName(),
            ITransitionDispatcherExecutor::FIELD__CONTEXT => $this->getContext(),
            ITransitionDispatcherExecutor::FIELD__TRANSITION => $transition,
            ITransitionDispatcherExecutor::FIELD__ENTITY_SOURCE => $entitySource,
            ITransitionDispatcherExecutor::FIELD__DISPATCHER => $this
        ]);

        return $executor($result, $entityEdited);
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
     * @return IRepository|mixed
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
