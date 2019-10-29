<?php
namespace extas\interfaces\workflows\entities;

use extas\interfaces\IHasClass;
use extas\interfaces\templates\ITemplate;

/**
 * Interface IWorkflowEntityTemplate
 *
 * @package extas\interfaces\workflows\entities
 * @author jeyroik@gmail.com
 */
interface IWorkflowEntityTemplate extends ITemplate, IHasClass
{
    const SUBJECT = 'extas.workflow.entity.template';
}
