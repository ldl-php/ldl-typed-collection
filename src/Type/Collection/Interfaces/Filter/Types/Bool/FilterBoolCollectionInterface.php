<?php declare(strict_types=1);

namespace LDL\Type\Collection\Filter\Types\Bool;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\Types\Bool\BoolCollection;

interface FilterBoolCollectionInterface
{
    /**
     * Filters all values which are booleans inside a collection and returns an BoolCollection.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return BoolCollection
     */
    public function filterBooleans() : BoolCollection;

}