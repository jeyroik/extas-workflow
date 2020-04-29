<?php
namespace extas\components\workflows\states;

use extas\components\workflows\exceptions\states\ExceptionStateMissed;
use extas\components\SystemContainer;
use extas\components\workflows\ItemsCollection;
use extas\interfaces\IItem;
use extas\interfaces\workflows\exceptions\states\IExceptionStateMissed;
use extas\interfaces\workflows\IItemsCollection;
use extas\interfaces\workflows\states\IState;
use extas\interfaces\workflows\states\IStateRepository;
use extas\interfaces\workflows\states\IStateSample;
use extas\interfaces\workflows\states\IStateSampleRepository;

/**
 * Trait THasStates
 *
 * @property $config
 * @method getName(): string
 *
 * @package extas\components\workflows\states
 * @author jeyroik@gmail.com
 */
trait THasStates
{
    protected ?IItemsCollection $statesCollection = null;

    /**
     * @return string[]
     */
    public function getStatesNames(): array
    {
        return $this->getStatesCollection()->getItemsNames();
    }

    /**
     * @return IState[]
     */
    public function getStates(): array
    {
        return $this->getStatesCollection()->getItems();
    }

    /**
     * @param string $name
     * @return IState|null
     */
    public function getState(string $name): ?IState
    {
        return $this->getStatesCollection()->getItem($name);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasState(string $name): bool
    {
        return $this->getStatesCollection()->hasItem($name);
    }

    /**
     * @param array $sampleNames
     * @return IItem[]|IState[]
     */
    public function addStates(array $sampleNames): array
    {
        /**
         * @var IStateSampleRepository $repo
         */
        $repo = SystemContainer::getItem(IStateSampleRepository::class);
        $samples = $repo->all([IStateSample::FIELD__NAME => $sampleNames]);
        $items = [];
        foreach ($samples as $sample) {
            $newState = new State();
            $items[] = $newState->buildFromSample($sample, '@sample(uuid6)');
        }
        return $this->getStatesCollection()->addItems($items);
    }

    /**
     * @param string $sampleName
     * @return IItem|IState
     */
    public function addState(string $sampleName): IState
    {
        /**
         * @var IStateSampleRepository $repo
         */
        $repo = SystemContainer::getItem(IStateSampleRepository::class);
        $sample = $repo->one([IStateSample::FIELD__NAME => $sampleName]);
        $state = new State();

        return $this->getStatesCollection()->addItem($state->buildFromSample($sample, '@sample(uuid6)'));
    }

    /**
     * @param string $name
     * @return $this
     * @throws IExceptionStateMissed
     */
    public function removeState(string $name)
    {
        try {
            $this->getStatesCollection()->removeItem($name);
        } catch (\Exception $e) {
            throw new ExceptionStateMissed($name);
        }

        return $this;
    }

    /**
     * @return IItemsCollection
     */
    protected function getStatesCollection(): IItemsCollection
    {
        return $this->statesCollection ?: $this->statesCollection = new ItemsCollection([
            IItemsCollection::FIELD__REPOSITORY => $this->getStatesRepository(),
            IItemsCollection::FIELD__REPOSITORY_QUERY => [IState::FIELD__SCHEMA_NAME => $this->getName()]
        ]);
    }

    /**
     * @return IStateRepository
     */
    protected function getStatesRepository()
    {
        return SystemContainer::getItem(IStateRepository::class);
    }
}
