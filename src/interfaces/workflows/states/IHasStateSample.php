<?php
namespace extas\interfaces\workflows\states;

/**
 * Interface IHasStateSample
 *
 * @package extas\interfaces\workflows\states
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasStateSample
{
    public const FIELD__STATE_SAMPLE_NAME = 'state_sample_name';

    /**
     * @return string
     */
    public function getStateSampleName(): string;

    /**
     * @return IStateSample|null
     */
    public function getStateSample(): ?IStateSample;

    /**
     * @param string $name
     * @return $this
     */
    public function setStateSampleName(string $name);
}
