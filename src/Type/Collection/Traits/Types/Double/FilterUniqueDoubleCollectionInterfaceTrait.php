<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Double;

use LDL\Framework\Base\Constants;
use LDL\Framework\Base\Contracts\Type\ToDoubleInterface;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\Helper\UniqueTypeHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Double\UniqueDoubleCollection;

trait FilterUniqueDoubleCollectionInterfaceTrait
{
    /**
     * Filters all values which are doubles inside a collection and returns a UniqueDoubleCollection.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @param bool $preferObjects
     * @return UniqueDoubleCollection
     */

    public function filterUniqueDoubles(bool $preferObjects=true) : UniqueDoubleCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new UniqueDoubleCollection(
            UniqueTypeHelper::unique(
                IterableHelper::filterByValueType($this, Constants::PHP_TYPE_DOUBLE),
                ToDoubleInterface::class,
                ToDoubleInterface::TO_DOUBLE_TYPE_METHOD_NAME,
                $preferObjects
            )
        );
    }
}