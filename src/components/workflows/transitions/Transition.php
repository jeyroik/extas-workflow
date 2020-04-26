<?php
namespace extas\components\workflows\transitions;

use extas\components\samples\THasSample;
use extas\components\workflows\schemas\THasSchema;
use extas\components\workflows\transitions\dispatchers\THasDispatchers;
use extas\interfaces\workflows\transitions\ITransition;

/**
 * Class Transition
 *
 * @package extas\components\workflows\transitions
 * @author jeyroik@gmail.com
 */
class Transition extends TransitionSample implements ITransition
{
    use THasSample;
    use THasDispatchers;
    use THasSchema;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'workflow.transition';
    }
}
