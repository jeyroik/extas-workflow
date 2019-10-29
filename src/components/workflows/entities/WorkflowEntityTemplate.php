<?php
namespace extas\components\workflows\entities;

use extas\components\templates\Template;
use extas\components\THasClass;
use extas\interfaces\workflows\entities\IWorkflowEntityTemplate;

/**
 * Class WorkflowEntityTemplate
 *
 * @package extas\components\workflows\entities
 * @author jeyroik@gmail.com
 */
class WorkflowEntityTemplate extends Template implements IWorkflowEntityTemplate
{
    use THasClass;
}
