<?php
namespace extas\components\workflows\transitions;

use extas\components\exceptions\MissedOrUnknown;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\IItemsCollection;
use extas\interfaces\workflows\transitions\ITransition;
use extas\interfaces\workflows\transitions\ITransitionSample;

/**
 * Trait THasTransitions
 *
 * @property array $config
 *
 * @method IRepository workflowTransitions()
 * @method IRepository workflowTransitionsSamples()
 *
 * @package extas\components\workflows\transitions
 * @author jeyroik@gmail.com
 */
trait THasTransitions
{
    /**
     * @return string[]
     */
    public function getTransitionsNames(): array
    {
        return array_column(
            $this->workflowTransitions()->all([
                ITransition::FIELD__SCHEMA_NAME => $this->getName()
            ]),
            ITransition::FIELD__NAME
        );
    }

    /**
     * @return ITransition[]
     */
    public function getTransitions(): array
    {
        return $this->workflowTransitions()->all([
            ITransition::FIELD__SCHEMA_NAME => $this->getName()
        ]);
    }

    /**
     * @param string $transitionName
     * @return ITransition|null
     */
    public function getTransition(string $transitionName): ?ITransition
    {
        return $this->workflowTransitions()->one([
            ITransition::FIELD__SCHEMA_NAME => $this->getName(),
            ITransition::FIELD__NAME => $transitionName
        ]);
    }

    /**
     * @param string $transitionName
     * @return bool
     */
    public function hasTransition(string $transitionName): bool
    {
        return $this->getTransition($transitionName) ? true : false;
    }

    /**
     * @param array $transitionsSamplesNames
     * @return ITransition[]
     */
    public function addTransitions(array $transitionsSamplesNames): array
    {
        $samples = $this->workflowTransitionsSamples()->all([
            ITransitionSample::FIELD__NAME => $transitionsSamplesNames
        ]);
        $items = [];
        foreach ($samples as $sample) {
            $items[] = $this->addTransition($sample->getName(), $sample);
        }

        return $items;
    }

    /**
     * @param string $transitionSampleName
     * @param ITransitionSample|null $sample
     * @return ITransition
     */
    public function addTransition(string $transitionSampleName, ITransitionSample $sample = null): ITransition
    {
        $sample = $sample ?? $this->workflowTransitionsSamples()->one([
            ITransitionSample::FIELD__NAME => $transitionSampleName
        ]);
        $new = new Transition();
        $new->buildFromSample($sample, '@sample(uuid6)');
        $new->setSchemaName($this->getName());

        return $this->workflowTransitions()->create($new);
    }

    /**
     * @param string $transitionName
     * @return $this
     */
    public function removeTransition(string $transitionName)
    {
        $this->workflowTransitions()->delete([ITransition::FIELD__NAME => $transitionName]);

        return $this;
    }
}
