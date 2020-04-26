<?php
namespace extas\interfaces\workflows\transitions\dispatchers;

use extas\interfaces\plugins\IPlugin;
use extas\interfaces\workflows\entities\IEntity;
use extas\interfaces\workflows\transits\ITransitResult;

/**
 * Interface ITransitionDispatcherExecutor
 *
 * @package extas\interfaces\workflows\transitions\dispatchers
 * @author jeyroik@gmail.com
 */
interface ITransitionDispatcherExecutor extends IPlugin, ITransitionDispatcher
{
    /**
     * @param ITransitResult $result
     * @param IEntity $entityEdited
     *
     * @return bool
     */
    public function __invoke(ITransitResult &$result, IEntity &$entityEdited): bool;
}
