<?php
namespace extas\components\workflows\states;

use extas\interfaces\IItem;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\states\IState;
use extas\interfaces\workflows\states\IStateSample;

/**
 * Trait THasStates
 *
 * @property $config
 * @method getName(): string
 * @method IRepository workflowStates()
 * @method IRepository workflowStatesSamples()
 *
 * @package extas\components\workflows\states
 * @author jeyroik@gmail.com
 */
trait THasStates
{
    /**
     * @return string[]
     */
    public function getStatesNames(): array
    {
        return array_column(
            $this->workflowStates()->all([
                IState::FIELD__SCHEMA_NAME => $this->getName()
            ]),
            IState::FIELD__NAME
        );
    }

    /**
     * @return IState[]
     */
    public function getStates(): array
    {
        return $this->workflowStates()->all([
            IState::FIELD__SCHEMA_NAME => $this->getName()
        ]);
    }

    /**
     * @param string $name
     * @return IState|null
     */
    public function getState(string $name): ?IState
    {
        return $this->workflowStates()->one([IState::FIELD__NAME => $name]);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasState(string $name): bool
    {
        return $this->getState($name) ? true : false;
    }

    /**
     * @param array $sampleNames
     * @return IItem[]|IState[]
     */
    public function addStates(array $sampleNames): array
    {
        $samples = $this->workflowStatesSamples()->all([IStateSample::FIELD__NAME => $sampleNames]);
        $items = [];

        foreach ($samples as $sample) {
            $items[] = $this->addState($sample->getName(), $sample);
        }

        return $items;
    }

    /**
     * @param string $sampleName
     * @param IStateSample|null $sample
     * @return IState
     */
    public function addState(string $sampleName, IStateSample $sample = null): IState
    {
        $sample = $sample ?: $this->workflowStatesSamples()->one([IStateSample::FIELD__NAME => $sampleName]);
        $state = new State();
        $state->buildFromSample($sample, '@sample(uuid6)');
        $state->setSchemaName($this->getName());

        return $this->workflowStates()->create($state);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function removeState(string $name)
    {
        $this->workflowStates()->delete([IState::FIELD__NAME => $name]);

        return $this;
    }
}
