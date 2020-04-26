<?php
namespace extas\components\workflows\transitions\dispatchers;

use extas\components\plugins\Plugin;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\samples\THasSample;
use extas\components\THasCreatedAt;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\components\THasType;
use extas\components\THasUpdatedAt;
use extas\components\workflows\transitions\THasTransition;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transits\ITransitResult;

/**
 * Class TransitionDispatcherExecutor
 *
 * @package extas\components\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
abstract class TransitionDispatcherExecutor extends Plugin implements ITransitionDispatcherExecutor
{
    use THasType;
    use THasSampleParameters;
    use THasName;
    use THasDescription;
    use THasSample;
    use THasCreatedAt;
    use THasUpdatedAt;
    use THasTransition;

     /**
      * @param IItem $context
      * @param ITransitResult $result
      * @param IEntity $entityEdited
      * @return bool
      */
    final public function dispatch(IItem $context, ITransitResult &$result, IEntity &$entityEdited): bool
    {
        return true;
    }

     /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.transition.dispatcher.executor';
    }
}
