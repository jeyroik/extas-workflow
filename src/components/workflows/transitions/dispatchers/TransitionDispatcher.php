<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\samples\THasSample;
use extas\components\THasPriority;
use extas\components\THasType;
use extas\components\workflows\transitions\THasTransition;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transits\ITransitResult;

/**
 * Class TransitionDispatcher
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
class TransitionDispatcher extends TransitionDispatcherSample implements ITransitionDispatcher
{
    use THasSample;
    use THasTransition;
    use THasPriority;
    use THasType;

    public function dispatch(IItem $context, ITransitResult &$result, IEntity &$entityEdited): bool
    {
        /**
         * @var ITransitionDispatcherExecutor $executor
         */
        $executor = $this->buildClassWithParameters($this->__toArray());

        return $executor($result, $entityEdited);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.workflow.transition.dispatcher';
    }
}
