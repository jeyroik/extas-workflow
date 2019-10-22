<?php
namespace extas\interfaces\workflows\states;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHasParameters;

/**
 * Interface IState
 *
 * @package extas\interfaces\workflows\states
 * @author jeyroik@gmail.com
 */
interface IWorkflowState extends IItem, IHasName, IHasDescription, IHasParameters
{
    const SUBJECT = 'extas.workflow.state';
}
