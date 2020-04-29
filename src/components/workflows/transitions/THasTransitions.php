<?php
namespace extas\components\workflows\transitions;

use extas\components\SystemContainer;
use extas\components\workflows\exceptions\transitions\ExceptionTransitionMissed;
use extas\components\workflows\ItemsCollection;
use extas\interfaces\IItem;
use extas\interfaces\workflows\exceptions\transitions\IExceptionTransitionMissed;
use extas\interfaces\workflows\IItemsCollection;
use extas\interfaces\workflows\transitions\ITransition;
use extas\interfaces\workflows\transitions\ITransitionRepository;
use extas\interfaces\workflows\transitions\ITransitionSample;
use extas\interfaces\workflows\transitions\ITransitionSampleRepository;

/**
 * Trait THasTransitions
 *
 * @property array $config
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
        /**
         * @var ITransitionSampleRepository $repo
         */
        $repo = SystemContainer::getItem(ITransitionSampleRepository::class);
        $samples = $repo->all([ITransitionSample::FIELD__NAME => $transitionsSamplesNames]);
        $items = [];
        foreach ($samples as $sample) {
            $new = new Transition();
            $items[] = $new->buildFromSample($sample, '@sample(uuid6)');
        }

        return $this->getTransitionCollection()->addItems($items);
    }

    /**
     * @param string $transitionSampleName
     * @return ITransition|IItem
     */
    public function addTransition(string $transitionSampleName): ITransition
    {
        /**
         * @var ITransitionSampleRepository $repo
         */
        $repo = SystemContainer::getItem(ITransitionSampleRepository::class);
        $sample = $repo->one([ITransitionSample::FIELD__NAME => $transitionSampleName]);
        $new = new Transition();
        return $this->getTransitionCollection()->addItem($new->buildFromSample($sample, '@sample(uuid6)'));
    }

    /**
     * @param string $transitionName
     * @return $this
     * @throws IExceptionTransitionMissed
     */
    public function removeTransition(string $transitionName)
    {
        try {
            $this->getStatesCollection()->removeItem($transitionName);
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
            IItemsCollection::FIELD__REPOSITORY => $this->getTransitionRepository(),
            IItemsCollection::FIELD__REPOSITORY_QUERY => [ITransition::FIELD__SCHEMA_NAME => $this->getName()]
        ]);
    }

    /**
     * @return ITransitionRepository
     */
    protected function getTransitionRepository()
    {
        return SystemContainer::getItem(ITransitionRepository::class);
    }
}
