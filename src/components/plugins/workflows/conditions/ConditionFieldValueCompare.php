<?php
namespace extas\components\plugins\workflows\conditions;

use extas\components\plugins\Plugin;
use extas\interfaces\IItem;
use extas\interfaces\workflows\entities\IWorkflowEntity;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcher;
use extas\interfaces\workflows\transitions\dispatchers\ITransitionDispatcherExecutor;
use extas\interfaces\workflows\transitions\errors\ITransitionErrorVocabulary;
use extas\interfaces\workflows\transitions\IWorkflowTransition;
use extas\interfaces\workflows\transitions\results\ITransitionResult;

/**
 * Class ConditionFieldValueCompare
 *
 * @package extas\components\plugins\workflows\conditions
 * @author jeyroik@gmail.com
 */
class ConditionFieldValueCompare extends Plugin implements ITransitionDispatcherExecutor
{
    public const TYPE__STRING = 'string';
    public const TYPE__NUMBER = 'number';

    /**
     * @param ITransitionDispatcher $dispatcher
     * @param IWorkflowTransition $transition
     * @param IWorkflowEntity $entitySource
     * @param IWorkflowSchema $schema
     * @param IItem $context
     * @param ITransitionResult $result
     * @param IWorkflowEntity $entityEdited
     *
     * @return bool
     */
    public function __invoke(
        ITransitionDispatcher $dispatcher,
        IWorkflowTransition $transition,
        IWorkflowEntity $entitySource,
        IWorkflowSchema $schema,
        IItem $context,
        ITransitionResult &$result,
        IWorkflowEntity &$entityEdited
    ): bool
    {
        $fieldName = $dispatcher->getParameter('field_name');
        $fieldValue = $dispatcher->getParameter('field_value');
        $fieldCompare = $dispatcher->getParameter('field_compare');
        $fieldType = $dispatcher->getParameter('field_type');

        if (!$fieldName || !$fieldValue || !$fieldCompare || !$fieldType) {
            $result->fail(ITransitionErrorVocabulary::ERROR__VALIDATION_FAILED, [
                'field_value_compare' =>
                    'Missed on of `field_name`, `field_value`, `field_compare`, `field_type` in the `'
                    . $dispatcher->getName() . '`'
            ]);
            return false;
        }

        $entityValue = isset($entity[$fieldName->getValue()]) ? $entitySource[$fieldName->getValue()] : null;

        if (method_exists($this, $fieldCompare->getValue() . 'Compare')) {
            $valid = $this->{$fieldCompare->getValue() . 'Compare'}(
                $fieldValue->getValue(),
                $entityValue,
                $fieldType->getValue(static::TYPE__STRING)
            );
        } else {
            $valid = $entityValue == $fieldValue->getValue();
        }

        if (!$valid) {
            $result->fail(ITransitionErrorVocabulary::ERROR__VALIDATION_FAILED, [
                'field_value_compare' => '`'
                    . $fieldName->getValue() . '` is not `'
                    . $fieldCompare->getValue() . '` to `'
                    . $fieldValue->getValue() . '`'
            ]);
        }

        return $valid;
    }

    /**
     * @param $first
     * @param $second
     * @param string $type
     *
     * @return bool
     */
    protected function equalCompare($first, $second, string $type): bool
    {
        $typeMap = [
            static::TYPE__STRING => function () use ($first, $second) {
                // strcmp == 0 if first == second
                return !strcmp($first, $second);
            },
            static::TYPE__NUMBER => function () use ($first, $second) {
                return $first == $second;
            }
        ];

        return isset($typeMap[$type]) ? $typeMap[$type]() : false;
    }

    /**
     * @param $first
     * @param $second
     * @param string $type
     *
     * @return bool
     */
    protected function notEqualCompare($first, $second, string $type): bool
    {
        return !$this->equalCompare($first, $second, $type);
    }

    /**
     * @param $first
     * @param $second
     * @param string $type
     *
     * @return bool
     */
    protected function greaterCompare($first, $second, string $type): bool
    {
        $typeMap = [
            static::TYPE__STRING => function () use ($first, $second) {
                // strcmp > 0 if first > second
                return strcmp($first, $second) > 0;
            },
            static::TYPE__NUMBER => function () use ($first, $second) {
                return $first > $second;
            }
        ];

        return isset($typeMap[$type]) ? $typeMap[$type]() : false;
    }

    /**
     * @param $first
     * @param $second
     * @param string $type
     *
     * @return bool
     */
    protected function lowerCompare($first, $second, string $type): bool
    {
        $typeMap = [
            static::TYPE__STRING => function () use ($first, $second) {
                // strcmp < 0 if first < second
                return strcmp($first, $second) < 0;
            },
            static::TYPE__NUMBER => function () use ($first, $second) {
                return $first < $second;
            }
        ];

        return isset($typeMap[$type]) ? $typeMap[$type]() : false;
    }

    /**
     * @param $first
     * @param $second
     * @param string $type
     *
     * @return bool
     */
    protected function greaterOrEqualCompare($first, $second, string $type): bool
    {
        return !$this->lowerCompare($first, $second, $type);
    }

    /**
     * @param $first
     * @param $second
     * @param string $type
     *
     * @return bool
     */
    protected function lowerOrEqualCompare($first, $second, string $type): bool
    {
        return !$this->greaterCompare($first, $second, $type);
    }

    /**
     * @param $first
     * @param $second
     * @param string $type
     *
     * @return bool
     */
    protected function likeCompare($first, $second, string $type): bool
    {
        $typeMap = [
            static::TYPE__STRING => function () use ($first, $second) {
                return strpos($first, $second) !== 0;
            },
            static::TYPE__NUMBER => function () use ($first, $second) {
                return strpos($first, $second) !== 0;
            }
        ];

        return isset($typeMap[$type]) ? $typeMap[$type]() : false;
    }

    /**
     * @param $first
     * @param $second
     * @param string $type
     *
     * @return bool
     */
    protected function notLikeCompare($first, $second, string $type): bool
    {
        return !$this->likeCompare($first, $second, $type);
    }

    /**
     * @param $first
     * @param $second
     * @param string $type
     *
     * @return bool
     */
    protected function emptyCompare($first, $second, string $type): bool
    {
        $typeMap = [
            static::TYPE__STRING => function () use ($first, $second) {
                return empty($second);
            },
            static::TYPE__NUMBER => function () use ($first, $second) {
                return empty($second);
            }
        ];

        return isset($typeMap[$type]) ? $typeMap[$type]() : false;
    }

    /**
     * @param $first
     * @param $second
     * @param string $type
     *
     * @return bool
     */
    protected function notEmptyCompare($first, $second, string $type): bool
    {
        return !$this->emptyCompare($first, $second, $type);
    }

    /**
     * @param $first
     * @param $second
     * @param string $type
     *
     * @return bool
     */
    protected function inCompare($first, $second, string $type): bool
    {
        $typeMap = [
            static::TYPE__STRING => function () use ($first, $second) {
                if (!is_array($first)) {
                    $first = [$first];
                }
                foreach ($first as $item) {
                    if (!strcmp($item, $second)) {
                        return true;
                    }
                }
                return false;
            },
            static::TYPE__NUMBER => function () use ($first, $second) {
                $first = is_array($first) ? $first : [$first];
                return in_array($second, $first);
            }
        ];

        return isset($typeMap[$type]) ? $typeMap[$type]() : false;
    }

    /**
     * @param $first
     * @param $second
     * @param string $type
     *
     * @return bool
     */
    protected function notInCompare($first, $second, string $type): bool
    {
        return !$this->inCompare($first, $second, $type);
    }
}
