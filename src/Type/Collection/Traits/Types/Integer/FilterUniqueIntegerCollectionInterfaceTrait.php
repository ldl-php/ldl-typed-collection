<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Integer;

use LDL\Framework\Base\Constants;
use LDL\Framework\Base\Contracts\Type\ToIntegerInterface;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\Helper\UniqueTypeHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Integer\UniqueIntegerCollection;

trait FilterUniqueIntegerCollectionInterfaceTrait
{
    /**
     * Filters all values which are integers inside a collection and returns an IntegerCollection,
     * also removes duplicate values.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @param bool $preferObjects
     * @return UniqueIntegerCollection
     */
    public function filterUniqueIntegers(bool $preferObjects=true) : UniqueIntegerCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new UniqueIntegerCollection(
            UniqueTypeHelper::unique(
                IterableHelper::filterByValueType($this, Constants::PHP_TYPE_INTEGER),
                ToIntegerInterface::class,
                ToIntegerInterface::TO_INTEGER_TYPE_METHOD_NAME,
                $preferObjects
            )
        );
    }
}