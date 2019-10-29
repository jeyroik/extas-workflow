<?php
namespace extas\interfaces\workflows\entities;

/**
 * Interface IWorkflowEntity
 *
 * @package extas\interfaces\workflows\entities
 * @author jeyroik@gmail.com
 */
interface IWorkflowEntity
{
    /**
     * @return string
     */
    public function getStateName(): string;

    /**
     * @param string $stateName
     *
     * @return IWorkflowEntity
     */
    public function setStateName(string $stateName): IWorkflowEntity;

    /**
     * @return string
     */
    public function getTemplateName(): string;
}
