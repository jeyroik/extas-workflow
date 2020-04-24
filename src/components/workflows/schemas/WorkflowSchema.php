<?php
namespace extas\components\workflows\schemas;

use extas\components\Item;
use extas\components\parameters\THasParameters;
use extas\components\SystemContainer;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\components\workflows\transitions\dispatchers\TransitionDispatcher;
use extas\components\workflows\transitions\results\TransitionResult;
use extas\components\workflows\transitions\WorkflowTransition;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\entities\IWorkflowEntityTemplate;
use extas\interfaces\workflows\entities\IWorkflowEntityTemplateRepository;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\states\IWorkflowState;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherRepository;
use extas\interfaces\workflows\transitions\IWorkflowTransition;
use extas\interfaces\workflows\transitions\IWorkflowTransitionRepository;

/**
 * Class WorkflowSchema
 *
 * @package extas\components\workflows\schemas
 * @author jeyroik@gmail.com
 */
class WorkflowSchema extends Item implements IWorkflowSchema
{
    use THasName;
    use THasDescription;
    use THasParameters;

    /**
     * @param string $templateName
     *
     * @return bool
     */
    public function isApplicableEntityTemplate(string $templateName): bool
    {
        return $this->getEntityTemplateName() == $templateName;
    }

    /**
     * @return IWorkflowEntityTemplate|null
     */
    public function getEntityTemplate(): ?IWorkflowEntityTemplate
    {
        return SystemContainer::getItem(IWorkflowEntityTemplateRepository::class)->one([
            IWorkflowEntityTemplate::FIELD__NAME => $this->getEntityTemplateName()
        ]);
    }

    /**
     * @return string
     */
    public function getEntityTemplateName(): string
    {
        return $this->config[static::FIELD__ENTITY_TEMPLATE] ?? '';
    }

    /**
     * @return ITransitionDispatcher[]
     */
    public function getConditions(): array
    {
        return SystemContainer::getItem(ITransitionDispatcherRepository::class)->all([
            ITransitionDispatcher::FIELD__SCHEMA_NAME => $this->getName(),
            ITransitionDispatcher::FIELD__TYPE => ITransitionDispatcher::TYPE__CONDITION
        ]);
    }

    /**
     * @param IWorkflowTransition|string $transition
     * @param IItem $withContext
     *
     * @return ITransitionDispatcher[]
     */
    public function getConditionsByTransition($transition, IItem $withContext): array
    {
        return $this->getDispatchersByTransition(
            $this->sureIsWorkflowTransition($transition),
            ITransitionDispatcher::TYPE__CONDITION,
            $withContext
        );
    }

    /**
     * @return ITransitionDispatcher[]
     */
    public function getValidators(): array
    {
        return SystemContainer::getItem(ITransitionDispatcherRepository::class)->all([
            ITransitionDispatcher::FIELD__SCHEMA_NAME => $this->getName(),
            ITransitionDispatcher::FIELD__TYPE => ITransitionDispatcher::TYPE__VALIDATOR
        ]);
    }

    /**
     * @param IWorkflowTransition|string $transition
     * @param IItem $withContext
     *
     * @return ITransitionDispatcher[]
     * @throws \Exception
     */
    public function getValidatorsByTransition($transition, IItem $withContext): array
    {
        return $this->getDispatchersByTransition(
            $this->sureIsWorkflowTransition($transition),
            ITransitionDispatcher::TYPE__VALIDATOR,
            $withContext
        );
    }

    /**
     * @return ITransitionDispatcher[]
     */
    public function getTriggers(): array
    {
        return SystemContainer::getItem(ITransitionDispatcherRepository::class)->all([
            ITransitionDispatcher::FIELD__SCHEMA_NAME => $this->getName(),
            ITransitionDispatcher::FIELD__TYPE => ITransitionDispatcher::TYPE__TRIGGER
        ]);
    }

    /**
     * @param IWorkflowTransition|string $transition
     * @param IItem $withContext
     *
     * @return ITransitionDispatcher[]
     */
    public function getTriggersByTransition($transition, IItem $withContext): array
    {
        return $this->getDispatchersByTransition(
            $this->sureIsWorkflowTransition($transition),
            ITransitionDispatcher::TYPE__TRIGGER,
            $withContext
        );
    }

    /**
     * @return IWorkflowTransition[]
     */
    public function getTransitions(): array
    {
        /**
         * @var IWorkflowTransitionRepository $transitionRepo
         */
        $transitionRepo = SystemContainer::getItem(IWorkflowTransitionRepository::class);

        return $transitionRepo->all([IWorkflowTransition::FIELD__NAME => $this->getTransitionsNames()]);
    }

    /**
     * @return string[]
     */
    public function getTransitionsNames(): array
    {
        return $this->config[static::FIELD__TRANSITIONS] ?? [];
    }

    /**
     * @param string $transitionName
     *
     * @return bool
     */
    public function hasTransition(string $transitionName): bool
    {
        $transitions = $this->getTransitionsNames();

        return in_array($transitionName, $transitions);
    }

    /**
     * @param IWorkflowEntityTemplate $template
     *
     * @return IWorkflowSchema
     */
    public function setEntityTemplate(IWorkflowEntityTemplate $template): IWorkflowSchema
    {
        $this->setEntityTemplateName($template->getName());

        return $this;
    }

    /**
     * @param string $templateName
     *
     * @return IWorkflowSchema
     */
    public function setEntityTemplateName(string $templateName): IWorkflowSchema
    {
        $this->config[static::FIELD__ENTITY_TEMPLATE] = $templateName;

        return $this;
    }

    /**
     * @param IWorkflowTransition $transition
     * @param string $conditionName
     * @param string $templateName
     * @param array $parameters
     *
     * @return IWorkflowSchema
     */
    public function setConditionByTransition(
        IWorkflowTransition $transition,
        string $conditionName,
        string $templateName,
        array $parameters
    ): IWorkflowSchema
    {
        return $this->setDispatcherByTransition(
            $transition,
            $conditionName,
            $parameters,
            ITransitionDispatcher::TYPE__CONDITION,
            $templateName
        );
    }

    /**
     * @param IWorkflowTransition $transition
     * @param string $validatorName
     * @param string $templateName
     * @param array $parameters
     *
     * @return IWorkflowSchema
     */
    public function setValidatorByTransition(
        IWorkflowTransition $transition,
        string $validatorName,
        string $templateName,
        array $parameters
    ): IWorkflowSchema
    {
        return $this->setDispatcherByTransition(
            $transition,
            $validatorName,
            $parameters,
            ITransitionDispatcher::TYPE__VALIDATOR,
            $templateName
        );
    }

    /**
     * @param IWorkflowTransition $transition
     * @param string $triggerName
     * @param string $templateName
     * @param array $parameters
     *
     * @return IWorkflowSchema
     */
    public function setTriggerByTransition(
        IWorkflowTransition $transition,
        string $triggerName,
        string $templateName,
        array $parameters
    ): IWorkflowSchema
    {
        return $this->setDispatcherByTransition(
            $transition,
            $triggerName,
            $parameters,
            ITransitionDispatcher::TYPE__TRIGGER,
            $templateName
        );
    }

    /**
     * @param string[]|IWorkflowTransition[] $transitions
     *
     * @return IWorkflowSchema
     */
    public function setTransitions(array $transitions): IWorkflowSchema
    {
        $transitionsNames = [];
        foreach ($transitions as $transition) {
            $transitionsNames[] = $transition instanceof IWorkflowTransition
                ? $transition->getName()
                : (string) $transition;
        }
        /**
         * @var IWorkflowTransitionRepository $transitRepo
         * @var IWorkflowTransition[] $transitionsExisting
         */
        $transitRepo = SystemContainer::getItem(IWorkflowTransitionRepository::class);
        $transitionsExisting = $transitRepo->all([IWorkflowTransition::FIELD__NAME => $transitionsNames]);

        if (count($transitionsNames) != count($transitionsExisting)) {
            $byNameExist = [];
            foreach ($transitionsExisting as $transition) {
                $byNameExist[] = $transition->getName();
            }
            $transitionsNames = array_intersect($transitionsNames, $byNameExist);
        }


        $this->config[static::FIELD__TRANSITIONS] = array_values($transitionsNames);

        return $this;
    }

    /**
     * @param IWorkflowEntity $entity
     * @param IItem $context
     * @param IWorkflowState|string $stateTo
     *
     * @return IWorkflowTransition|null
     */
    public function getTransition(IWorkflowEntity $entity, IItem $context, $stateTo): ?IWorkflowTransition
    {
        $stateFrom = $entity->getStateName();
        $stateTo = $stateTo instanceof IWorkflowState ? $stateTo->getName() : (string) $stateTo;

        /**
         * @var IWorkflowTransitionRepository $transitionRepo
         * @var ITransitionDispatcherRepository $dispatcherRepo
         * @var IWorkflowTransition $transition IWorkflowTransition
         * @var ITransitionDispatcher[] $conditions
         */
        $transitionRepo = SystemContainer::getItem(IWorkflowTransitionRepository::class);
        $dispatcherRepo = SystemContainer::getItem(ITransitionDispatcherRepository::class);

        $transition = $transitionRepo->one([
            IWorkflowTransition::FIELD__NAME => $this->getTransitionsNames(),
            IWorkflowTransition::FIELD__STATE_FROM => $stateFrom,
            IWorkflowTransition::FIELD__STATE_TO => $stateTo
        ]);

        if ($transition) {
            $conditions = $dispatcherRepo->all([
                ITransitionDispatcher::FIELD__TYPE => ITransitionDispatcher::TYPE__CONDITION,
                ITransitionDispatcher::FIELD__TRANSITION_NAME => $transition->getName()
            ]);

            $result = new TransitionResult();

            foreach ($conditions as $condition) {
                if (!$condition->dispatch($transition, $entity, $result, $entity)) {
                    return null;
                }
            }
        }

        return $transition;
    }

    /**
     * @param IWorkflowEntity $entity
     * @param IItem $context
     * @param IWorkflowState|string $stateTo
     *
     * @return bool
     */
    public function canTransit(IWorkflowEntity $entity, IItem $context, $stateTo): bool
    {
        $transition = $this->getTransition($entity, $context, $stateTo);
        return $transition ? true : false;
    }

    /**
     * @param IWorkflowEntity $entity
     * @param IItem $context
     *
     * @return IWorkflowTransition[]
     */
    public function getAvailableTransitionsByFromState(IWorkflowEntity $entity, IItem $context): array
    {
        return $this->getAvailableTransitionByState($entity, $context, true);
    }

    /**
     * @param IWorkflowEntity $entity
     * @param IItem $context
     *
     * @return array
     */
    public function getAvailableTransitionsByToState(IWorkflowEntity $entity, IItem $context): array
    {
        return $this->getAvailableTransitionByState($entity, $context, false);
    }

    /**
     * @param IWorkflowTransition $transition
     *
     * @return IWorkflowSchema
     */
    public function addTransition(IWorkflowTransition $transition): IWorkflowSchema
    {
        $this->config[static::FIELD__TRANSITIONS] = $this->config[static::FIELD__TRANSITIONS] ?? [];
        $this->config[static::FIELD__TRANSITIONS][] = $transition->getName();

        return $this;
    }

    /**
     * @param IWorkflowTransition $transition
     *
     * @return IWorkflowSchema
     */
    public function removeTransition(IWorkflowTransition $transition): IWorkflowSchema
    {
        $this->config[static::FIELD__TRANSITIONS] = $this->config[static::FIELD__TRANSITIONS] ?? [];

        $transitionsByName = array_flip($this->config[static::FIELD__TRANSITIONS]);

        if (isset($transitionsByName[$transition->getName()])) {
            unset($transitionsByName[$transition->getName()]);
            $this->config[static::FIELD__TRANSITIONS] = array_keys($transitionsByName);

            /**
             * @var ITransitionDispatcherRepository $dispatchersRepo
             * @var ITransitionDispatcher $dispatchers
             */
            $dispatchersRepo = SystemContainer::getItem(ITransitionDispatcherRepository::class);
            $dispatchersRepo->delete([
                ITransitionDispatcher::FIELD__TRANSITION_NAME => $transition->getName(),
                ITransitionDispatcher::FIELD__SCHEMA_NAME => $this->getName()
            ]);
        }

        return $this;
    }

    /**
     * @param IWorkflowTransition $transition
     * @param string $type
     * @param IItem $context
     *
     * @return ITransitionDispatcher[]
     */
    protected function getDispatchersByTransition(IWorkflowTransition $transition, string $type, IItem $context): array
    {
        /**
         * @var ITransitionDispatcherRepository $repo
         * @var ITransitionDispatcher[] $dispatchers
         */
        $repo = SystemContainer::getItem(ITransitionDispatcherRepository::class);

        $dispatchers = $repo->all(
            [
                ITransitionDispatcher::FIELD__SCHEMA_NAME => $this->getName(),
                ITransitionDispatcher::FIELD__TRANSITION_NAME => [
                    $transition->getName(),
                    ITransitionDispatcher::TRANSITION__ANY
                ],
                ITransitionDispatcher::FIELD__TYPE => $type
            ],
            0,
            0,
            [ITransitionDispatcher::FIELD__PRIORITY, -1]
        );

        foreach ($dispatchers as $index => &$dispatcher) {
            $dispatcher->setContext($context);
        }

        return $dispatchers;
    }

    /**
     * @param IWorkflowTransition $transition
     * @param string $dispatcherName
     * @param array $parameters
     * @param string $dispatcherType
     * @param string $templateName
     *
     * @return $this
     */
    protected function setDispatcherByTransition(
        IWorkflowTransition $transition,
        string $dispatcherName,
        array $parameters,
        string $dispatcherType,
        string $templateName
    )
    {
        /**
         * @var ITransitionDispatcherRepository $repo
         */
        $repo = SystemContainer::getItem(ITransitionDispatcherRepository::class);
        $dispatcher = new TransitionDispatcher();
        $dispatcher->setName($dispatcherName)
            ->setType($dispatcherType)
            ->setSchemaName($this->getName())
            ->setTransitionName($transition->getName())
            ->setParameters($parameters)
            ->setTemplateName($templateName);
        $repo->create($dispatcher);

        return $this;
    }

    /**
     * @param IWorkflowEntity $entity
     * @param IItem $context
     * @param bool $from
     *
     * @return IWorkflowTransition[]
     */
    protected function getAvailableTransitionByState(
        IWorkflowEntity $entity,
        IItem $context,
        bool $from = false
    )
    {
        /**
         * @var IWorkflowTransitionRepository $transitionRepo
         * @var ITransitionDispatcherRepository $dispatcherRepo
         * @var IWorkflowTransition[] $transitions
         * @var ITransitionDispatcher[] $conditions
         */
        $dispatcherRepo = SystemContainer::getItem(ITransitionDispatcherRepository::class);
        $stateField = $from ? IWorkflowTransition::FIELD__STATE_FROM : IWorkflowTransition::FIELD__STATE_TO;
        $transitionRepo = SystemContainer::getItem(IWorkflowTransitionRepository::class);
        $transitions = $transitionRepo->all([
            IWorkflowTransition::FIELD__NAME => $this->getTransitionsNames(),
            $stateField => $entity->getStateName()
        ]);
        $transitionNames = [];
        foreach ($transitions as $transition) {
            $transitionNames[$transition->getName()] = $transition;
        }

        $conditions = $dispatcherRepo->all([
            ITransitionDispatcher::FIELD__TYPE => ITransitionDispatcher::TYPE__CONDITION,
            ITransitionDispatcher::FIELD__TRANSITION_NAME => array_keys($transitionNames)
        ]);

        $result = new TransitionResult();

        foreach ($conditions as $condition) {
            if (!isset($transitionNames[$condition->getTransitionName()])) {
                continue;
            }
            $condition->setContext($context);
            $transition = $transitionNames[$condition->getTransitionName()];
            if (!$condition->dispatch($transition, $entity, $result, $entity)) {
                unset($transitionNames[$condition->getTransitionName()]);
            }
        }

        return array_values($transitionNames);
    }

    /**
     * @param string|IWorkflowTransition $transition
     *
     * @return IWorkflowTransition
     */
    protected function sureIsWorkflowTransition($transition)
    {
        return is_string($transition)
            ? new WorkflowTransition([WorkflowTransition::FIELD__NAME => $transition])
            : $transition;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
