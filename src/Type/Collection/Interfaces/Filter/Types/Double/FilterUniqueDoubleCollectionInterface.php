<?php declare(strict_types=1);

namespace LDL\Type\Collection\Filter\Types\Double;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\Types\Double\UniqueDoubleCollection;

interface FilterUniqueDoubleCollectionInterface
{
    /**
     * Filters all values which are doubles inside a collection and returns a UniqueDoubleCollection.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return UniqueDoubleCollection
     */

    public function filterUniqueDoubles() : UniqueDoubleCollection;

}