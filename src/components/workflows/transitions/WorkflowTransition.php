<?php
namespace extas\components\workflows\transitions;

use extas\components\Item;
use extas\components\SystemContainer;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\interfaces\workflows\states\IWorkflowState;
use extas\interfaces\workflows\states\IWorkflowStateRepository;
use extas\interfaces\workflows\transitions\IWorkflowTransition;

/**
 * Class Transition
 *
 * @package extas\components\workflows\transitions
 * @author jeyroik@gmail.com
 */
class WorkflowTransition extends Item implements IWorkflowTransition
{
    use THasName;
    use THasDescription;

    /**
     * @return IWorkflowState|null
     */
    public function getStateFrom(): ?IWorkflowState
    {
        return $this->getState(true);
    }

    /**
     * @return string
     */
    public function getStateFromName(): string
    {
        return $this->config[static::FIELD__STATE_FROM] ?? '';
    }

    /**
     * @return IWorkflowState|null
     */
    public function getStateTo(): ?IWorkflowState
    {
        return $this->getState(false);
    }

    /**
     * @return string
     */
    public function getStateToName(): string
    {
        return $this->config[static::FIELD__STATE_TO] ?? '';
    }

    /**
     * @param IWorkflowState|string $state
     *
     * @return IWorkflowTransition
     */
    public function setStateFrom($state): IWorkflowTransition
    {
        $this->config[static::FIELD__STATE_FROM] = $state instanceof IWorkflowState
            ? $state->getName()
            : (string) $state;

        return $this;
    }

    /**
     * @param IWorkflowState|string $state
     *
     * @return IWorkflowTransition
     */
    public function setStateTo($state): IWorkflowTransition
    {
        $this->config[static::FIELD__STATE_TO] = $state instanceof IWorkflowState
            ? $state->getName()
            : (string) $state;

        return $this;
    }

    /**
     * @param bool $from
     *
     * @return IWorkflowState|null
     */
    protected function getState(bool $from): ?IWorkflowState
    {
        /**
         * @var IWorkflowStateRepository $stateRepo
         */
        $stateRepo = SystemContainer::getItem(IWorkflowStateRepository::class);

        return $stateRepo->one([
            IWorkflowState::FIELD__NAME => $from ? $this->getStateFromName() : $this->getStateToName()
        ]);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
