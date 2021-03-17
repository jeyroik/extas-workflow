<?php
namespace extas\components\workflows\states;

use extas\interfaces\repositories\IRepository;
use extas\interfaces\workflows\states\IHasStateSample;
use extas\interfaces\workflows\states\IStateSample;

/**
 * Trait THasStateSample
 *
 * @property array $config
 * @method IRepository workflowStatesSamples()
 *
 * @package extas\components\workflows\states
 * @author jeyroik@gmail.com
 */
trait THasStateSample
{
    /**
     * @return string
     */
    public function getStateSampleName(): string
    {
        return $this->config[IHasStateSample::FIELD__STATE_SAMPLE_NAME] ?? '';
    }

    /**
     * @return IStateSample|null
     */
    public function getStateSample(): ?IStateSample
    {
        return $this->workflowStatesSamples()->one([
            IStateSample::FIELD__NAME => $this->getStateSampleName()
        ]);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setStateSampleName(string $name)
    {
        $this->config[IHasStateSample::FIELD__STATE_SAMPLE_NAME] = $name;

        return $this;
    }
}
