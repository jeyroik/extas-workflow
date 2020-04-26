<?php
namespace extas\interfaces\workflows\transitions\dispatchers;

use extas\interfaces\workflows\exceptions\transitions\dispatchers\IExceptionDispatcherMissed;

/**
 * Interface IHasDispatchers
 *
 * @package extas\interfaces\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
interface IHasDispatchers
{
    public const FIELD__CONDITIONS_NAMES = 'conditions';
    public const FIELD__VALIDATORS_NAMES = 'validators';
    public const FIELD__TRIGGERS_NAMES = 'triggers';

    /**
     * @return array
     */
    public function getConditionsNames(): array;

    /**
     * @return ITransitionDispatcher[]
     */
    public function getConditions(): array;

    /**
     * @return array
     */
    public function getValidatorsNames(): array;

    /**
     * @return ITransitionDispatcher[]
     */
    public function getValidators(): array;

    /**
     * @return array
     */
    public function getTriggersNames(): array;

    /**
     * @return ITransitionDispatcher[]
     */
    public function getTriggers(): array;

    /**
     * @param array $names
     * @return $this
     */
    public function setConditionsNames(array $names);

    /**
     * @param array $names
     * @return $this
     */
    public function setValidatorsNames(array $names);

    /**
     * @param array $names
     * @return $this
     */
    public function setTriggersNames(array $names);

    /**
     * @param string $name
     * @return $this
     */
    public function addConditionName(string $name);

    /**
     * @param string $name
     * @return $this
     */
    public function addValidatorName(string $name);

    /**
     * @param string $name
     * @return $this
     */
    public function addTriggerName(string $name);

    /**
     * @param string $name
     * @return $this
     * @throws IExceptionDispatcherMissed
     */
    public function removeConditionName(string $name);

    /**
     * @param string $name
     * @return $this
     * @throws IExceptionDispatcherMissed
     */
    public function removeValidatorName(string $name);

    /**
     * @param string $name
     * @return $this
     * @throws IExceptionDispatcherMissed
     */
    public function removeTriggerName(string $name);
}