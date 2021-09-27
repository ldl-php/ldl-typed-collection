<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\String;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\String\UniqueStringCollection;

trait FilterUniqueStringCollectionInterfaceTrait
{
    /**
     * Filters all values which are strings inside a collection and returns a UniqueStringCollection.
     *
     * If there are objects within your collection which have the __toString method, said
     * objects will be casted to string.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return UniqueStringCollection
     */
    public function filterUniqueStrings(): UniqueStringCollection
    {
        ClassHelper::mustHaveInterface(__CLASS__,TypedCollectionInterface::class);

        return new UniqueStringCollection(
            IterableHelper::unique(
                IterableHelper::filterByValueType($this, Constants::PHP_TYPE_STRING)
            )
        );
    }
}