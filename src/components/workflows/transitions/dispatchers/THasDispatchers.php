<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\SystemContainer;
use extas\components\workflows\exceptions\transitions\dispatchers\ExceptionDispatcherMissed;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\exceptions\transitions\dispatchers\IExceptionDispatcherMissed;
use extas\interfaces\workflows\transitions\dispatchers\IHasDispatchers;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherRepository;

/**
 * Trait THasDispatchers
 *
 * @property array $config
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
trait THasDispatchers
{
    /**
     * @return array
     */
    public function getConditionsNames(): array
    {
        return $this->config[IHasDispatchers::FIELD__CONDITIONS_NAMES] ?? [];
    }

    /**
     * @return ITransitionDispatcher[]
     */
    public function getConditions(): array
    {
        return $this->getDispatchers($this->getConditionsNames(), ITransitionDispatcher::TYPE__CONDITION);
    }

    /**
     * @return array
     */
    public function getValidatorsNames(): array
    {
        return $this->config[IHasDispatchers::FIELD__VALIDATORS_NAMES] ?? [];
    }

    /**
     * @return ITransitionDispatcher[]
     */
    public function getValidators(): array
    {
        return $this->getDispatchers($this->getValidatorsNames(), ITransitionDispatcher::TYPE__VALIDATOR);
    }

    /**
     * @return array
     */
    public function getTriggersNames(): array
    {
        return $this->config[IHasDispatchers::FIELD__TRIGGERS_NAMES] ?? [];
    }

    /**
     * @return ITransitionDispatcher[]
     */
    public function getTriggers(): array
    {
        return $this->getDispatchers($this->getTriggersNames(), ITransitionDispatcher::TYPE__TRIGGER);
    }

    /**
     * @param array $names
     * @return $this
     */
    public function setConditionsNames(array $names)
    {
        $this->config[IHasDispatchers::FIELD__CONDITIONS_NAMES] = $names;
        return $this;
    }

    /**
     * @param array $names
     * @return $this
     */
    public function setValidatorsNames(array $names)
    {
        $this->config[IHasDispatchers::FIELD__VALIDATORS_NAMES] = $names;
        return $this;
    }

    /**
     * @param array $names
     * @return $this
     */
    public function setTriggersNames(array $names)
    {
        $this->config[IHasDispatchers::FIELD__TRIGGERS_NAMES] = $names;
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function addConditionName(string $name)
    {
        $names = $this->getConditionsNames();
        if (!in_array($name, $names)) {
            $names[] = $name;
            $this->setConditionsNames($names);
        }

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function addValidatorName(string $name)
    {
        $names = $this->getValidatorsNames();
        if (!in_array($name, $names)) {
            $names[] = $name;
            $this->setValidatorsNames($names);
        }

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function addTriggerName(string $name)
    {
        $names = $this->getTriggersNames();
        if (!in_array($name, $names)) {
            $names[] = $name;
            $this->setTriggersNames($names);
        }

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     * @throws IExceptionDispatcherMissed
     */
    public function removeConditionName(string $name)
    {
        $names = $this->getConditionsNames();
        if (in_array($name, $names)) {
            $names = array_flip($names);
            unset($names[$name]);
            $this->setConditionsNames(array_keys($names));

            return $this;
        }

        throw new ExceptionDispatcherMissed($name);
    }

    /**
     * @param string $name
     * @return $this
     * @throws IExceptionDispatcherMissed
     */
    public function removeValidatorName(string $name)
    {
        $names = $this->getValidatorsNames();
        if (in_array($name, $names)) {
            $names = array_flip($names);
            unset($names[$name]);
            $this->setValidatorsNames(array_keys($names));

            return $this;
        }

        throw new ExceptionDispatcherMissed($name);
    }

    /**
     * @param string $name
     * @return $this
     * @throws IExceptionDispatcherMissed
     */
    public function removeTriggerName(string $name)
    {
        $names = $this->getTriggersNames();
        if (in_array($name, $names)) {
            $names = array_flip($names);
            unset($names[$name]);
            $this->setTriggersNames(array_keys($names));

            return $this;
        }

        throw new ExceptionDispatcherMissed($name);
    }

    /**
     * @param array $names
     * @param string $type
     * @return array
     */
    protected function getDispatchers(array $names, string $type)
    {
        /**
         * @var IRepository $repo
         */
        $repo = SystemContainer::getItem(ITransitionDispatcherRepository::class);

        return $repo->all([
            ITransitionDispatcher::FIELD__NAME => $names,
            ITransitionDispatcher::FIELD__TYPE => $type
        ]);
    }
}
