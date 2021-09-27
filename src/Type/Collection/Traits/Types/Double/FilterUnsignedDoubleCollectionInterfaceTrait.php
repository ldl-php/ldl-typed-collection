<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Double;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Double\UnsignedDoubleCollection;

trait FilterUnsignedDoubleCollectionInterfaceTrait
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
    public function filterUnsignedDoubles() : UnsignedDoubleCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new UnsignedDoubleCollection(
            IterableHelper::filterByValueType($this, Constants::LDL_TYPE_UDOUBLE)
        );
    }
}