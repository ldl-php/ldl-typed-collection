<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Sorting;

use LDL\Framework\Contracts\PriorityInterface;
use LDL\Type\Collection\TypedCollectionInterface;

interface PrioritySortingInterface extends CollectionSortInterface
{
    /**
     * Sorts a collection by priority and returns a new collection sorted by order
     *
     * Note: Every object in the collection MUST implements PriorityInterface
     *
     * @param string $order, the order in which to sort, order must be one of:
     *
     *  CollectionSortInterface::SORT_ASCENDING
     *  CollectionSortInterface::SORT_DESCENDING
     *
     * @see CollectionSortInterface
     * @see PriorityInterface
     *
     * @throws \InvalidArgumentException If an element of the collection does not implements PriorityInterface
     *
     * @return TypedCollectionInterface
     */
    public function sortByPriority(string $order=self::SORT_ASCENDING) : TypedCollectionInterface;
}