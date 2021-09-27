<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Integer;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Integer\UnsignedIntegerCollection;

trait FilterUnsignedIntegerCollectionInterfaceTrait
{
    /**
     * Filters all values which are unsigned integers (values greater than 0) inside a collection
     * and returns an UnsignedIntegerCollection.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return UnsignedIntegerCollection
     */
    public function filterUnsignedIntegers() : UnsignedIntegerCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new UnsignedIntegerCollection(
            IterableHelper::filterByValueType($this, Constants::LDL_TYPE_UINT)
        );
    }
}