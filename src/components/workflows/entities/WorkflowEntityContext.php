<?php
namespace extas\components\workflows\entities;

use extas\components\Item;

/**
 * Class WorkflowEntityContext
 *
 * @package extas\components\workflows\entities
 * @author jeyroik@gmail.com
 */
class WorkflowEntityContext extends Item
{
    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.workflow.entity.context';
    }
}
