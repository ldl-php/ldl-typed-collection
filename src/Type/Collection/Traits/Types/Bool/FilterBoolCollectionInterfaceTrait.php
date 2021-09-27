<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Bool;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Bool\BoolCollection;

trait FilterBoolCollectionInterfaceTrait
{
    /**
     * Filters all values which are booleans inside a collection and returns an BoolCollection.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return BoolCollection
     */
    public function filterBooleans() : BoolCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new BoolCollection(
            IterableHelper::filterByValueType($this, Constants::PHP_TYPE_BOOL)
        );
    }
}