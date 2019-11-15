<?php
namespace extas\components\workflows\entities;

use extas\components\Item;
use extas\interfaces\workflows\entities\IWorkflowEntity;

/**
 * Class WorkflowEntity
 *
 * @package extas\components\workflows\entities
 * @author jeyroik@gmail.com
 */
class WorkflowEntity extends Item implements IWorkflowEntity
{
    /**
     * @return string
     */
    public function getStateName(): string
    {
        return $this->config[static::FIELD__STATE] ?? '';
    }

    /**
     * @param string $stateName
     *
     * @return IWorkflowEntity
     */
    public function setStateName(string $stateName): IWorkflowEntity
    {
        $this->config[static::FIELD__STATE] = $stateName;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplateName(): string
    {
        return $this->config[static::FIELD__TEMPLATE] ?? '';
    }

    /**
     * @param string $templateName
     *
     * @return IWorkflowEntity
     */
    public function setTemplateName(string $templateName): IWorkflowEntity
    {
        $this->config[static::FIELD__TEMPLATE] = $templateName;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
