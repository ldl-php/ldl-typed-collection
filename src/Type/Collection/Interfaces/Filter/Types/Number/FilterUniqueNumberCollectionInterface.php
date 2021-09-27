<?php declare(strict_types=1);

namespace LDL\Type\Collection\Filter\Types\Number;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\Types\Numeric\UniqueNumericCollection;

interface FilterUniqueNumberCollectionInterface
{
    /**
     * Filters all values which are numbers (doubles or integers) inside a collection
     * and returns a UniqueNumberCollection (with no duplicate values).
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return UniqueNumericCollection
     */
    public function filterUniqueNumbers() : UniqueNumericCollection;

}