<?php
namespace extas\components\workflows\transitions;

use extas\components\workflows\exceptions\transitions\ExceptionTransitionMissed;
use extas\components\workflows\ItemsCollection;
use extas\interfaces\IItem;
use extas\interfaces\workflows\exceptions\transitions\IExceptionTransitionMissed;
use extas\interfaces\workflows\IItemsCollection;
use extas\interfaces\workflows\transitions\ITransition;
use extas\interfaces\workflows\transitions\ITransitionSample;

/**
 * Trait THasTransitions
 *
 * @property array $config
 * @method workflowTransitionRepository()
 * @method workflowTransitionSampleRepository()
 *
 * @package extas\components\workflows\transitions
 * @author jeyroik@gmail.com
 */
trait THasTransitions
{
    protected ?IItemsCollection $transitCollection = null;

    /**
     * @return string[]
     */
    public function getTransitionsNames(): array
    {
        return $this->getTransitionCollection()->getItemsNames();
    }

    /**
     * @return ITransition[]
     */
    public function getTransitions(): array
    {
        return $this->getTransitionCollection()->getItems();
    }

    /**
     * @param string $transitionName
     * @return ITransition|null
     */
    public function getTransition(string $transitionName): ?ITransition
    {
        return $this->getTransitionCollection()->getItem($transitionName);
    }

    /**
     * @param string $transitionName
     * @return bool
     */
    public function hasTransition(string $transitionName): bool
    {
        return $this->getTransitionCollection()->hasItem($transitionName);
    }

    /**
     * @param array $transitionsSamplesNames
     * @return ITransition[]
     */
    public function addTransitions(array $transitionsSamplesNames): array
    {
        $samples = $this->workflowTransitionSampleRepository()->all([
            ITransitionSample::FIELD__NAME => $transitionsSamplesNames
        ]);
        $items = [];
        foreach ($samples as $sample) {
            $new = new Transition();
            $new->buildFromSample($sample, '@sample(uuid6)');
            $items[] = $new->setSchemaName($this->getName());
        }

        return $this->getTransitionCollection()->addItems($items);
    }

    /**
     * @param string $transitionSampleName
     * @return ITransition|IItem
     */
    public function addTransition(string $transitionSampleName): ITransition
    {
        $sample = $this->workflowTransitionSampleRepository()->one([
            ITransitionSample::FIELD__NAME => $transitionSampleName
        ]);
        $new = new Transition();
        $new->buildFromSample($sample, '@sample(uuid6)');
        $new->setSchemaName($this->getName());

        return $this->getTransitionCollection()->addItem($new);
    }

    /**
     * @param string $transitionName
     * @return $this
     * @throws IExceptionTransitionMissed
     */
    public function removeTransition(string $transitionName)
    {
        try {
            $this->getTransitionCollection()->removeItem($transitionName);
        } catch (\Exception $e) {
            throw new ExceptionTransitionMissed($transitionName);
        }

        return $this;
    }

    /**
     * @return IItemsCollection
     */
    protected function getTransitionCollection(): IItemsCollection
    {
        return $this->transitCollection ?: $this->transitCollection = new ItemsCollection([
            IItemsCollection::FIELD__REPOSITORY => $this->workflowTransitionRepository(),
            IItemsCollection::FIELD__REPOSITORY_QUERY => [ITransition::FIELD__SCHEMA_NAME => $this->getName()]
        ]);
    }
}
