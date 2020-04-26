<?php
namespace extas\components\workflows\states;

use extas\components\samples\THasSample;
use extas\components\workflows\schemas\THasSchema;
use extas\interfaces\workflows\states\IState;

/**
 * Class State
 *
 * @package extas\components\states
 * @author jeyroik@gmail.com
 */
class State extends StateSample implements IState
{
    use THasSchema;
    use THasSample;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.workflow.state';
    }
}
