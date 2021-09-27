<?php declare(strict_types=1);

namespace LDL\Type\Collection\Filter\Types\Integer;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\Types\Integer\UniqueIntegerCollection;

interface FilterUniqueIntegerCollectionInterface
{
    /**
     * Filters all values which are integers inside a collection and returns an IntegerCollection,
     * also removes duplicate values.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return UniqueIntegerCollection
     */
    public function filterUniqueIntegers() : UniqueIntegerCollection;

}