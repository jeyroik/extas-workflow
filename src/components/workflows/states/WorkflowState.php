<?php
namespace extas\components\workflows\states;

use extas\components\Item;
use extas\components\parameters\THasParameters;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\interfaces\workflows\states\IWorkflowState;

/**
 * Class State
 *
 * @package extas\components\states
 * @author jeyroik@gmail.com
 */
class WorkflowState extends Item implements IWorkflowState
{
    use THasName;
    use THasDescription;
    use THasParameters;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
