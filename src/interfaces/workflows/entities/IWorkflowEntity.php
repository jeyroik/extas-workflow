<?php
namespace extas\interfaces\workflows\entities;

use extas\interfaces\IItem;

/**
 * Interface IWorkflowEntity
 *
 * @package extas\interfaces\workflows\entities
 * @author jeyroik@gmail.com
 */
interface IWorkflowEntity extends IItem
{
    const SUBJECT = 'extas.workflow.entity';

    const FIELD__STATE = 'state';
    const FIELD__TEMPLATE = 'workflow_template';

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

    /**
     * @param string $templateName
     *
     * @return IWorkflowEntity
     */
    public function setTemplateName(string $templateName): IWorkflowEntity;
}
