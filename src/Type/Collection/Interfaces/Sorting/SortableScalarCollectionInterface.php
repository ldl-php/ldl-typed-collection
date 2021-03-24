<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Sorting;

use LDL\Type\Collection\TypedCollectionInterface;

interface SortableScalarCollectionInterface extends CollectionSortInterface
{
    public function sort(string $sort=self::SORT_ASCENDING) : TypedCollectionInterface;
}