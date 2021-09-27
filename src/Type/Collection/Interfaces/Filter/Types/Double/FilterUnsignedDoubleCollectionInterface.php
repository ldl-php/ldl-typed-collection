<?php declare(strict_types=1);

namespace LDL\Type\Collection\Filter\Types\Double;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\Types\Double\UnsignedDoubleCollection;

interface FilterUnsignedDoubleCollectionInterface
{
    /**
     * Filters all values which are unsigned doubles inside a collection (greater than 0.0)
     * an returns an UniqueDoubleCollection.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return UnsignedDoubleCollection
     */
    public function filterUnsignedDoubles() : UnsignedDoubleCollection;

}