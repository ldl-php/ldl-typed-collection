<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Double;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Double\DoubleCollection;

trait FilterDoubleCollectionInterfaceTrait
{
    /**
     * Filters all values which are doubles inside a collection and returns an DoubleCollection.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return DoubleCollection
     */
    public function filterDoubles() : DoubleCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new DoubleCollection(
            IterableHelper::filterByValueType($this, Constants::PHP_TYPE_DOUBLE)
        );
    }
}