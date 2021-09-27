<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Number;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Numeric\UnsignedNumericCollection;

trait FilterUnsignedNumberCollectionInterfaceTrait
{
    /**
     * Filters all values which are numbers (doubles or integers) greater than 0 inside a collection
     * and returns an UnsignedNumberCollection.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return UnsignedNumericCollection
     */
    public function filterUnsignedNumbers() : UnsignedNumericCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new UnsignedNumericCollection(
            IterableHelper::filterByValueType(
                $this,
                Constants::LDL_TYPE_UNUMERIC
            )
        );
    }
}