<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Object;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\Helper\TypeCollectionHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Object\ObjectCollection;

trait FilterObjectCollectionInterfaceTrait
{
    /**
     * Filters all values which are objects inside a collection and returns an ObjectCollection.
     *
     * This is useful when you have a custom collection with mixed values and you want to get all objects.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return ObjectCollection
     */
    public function filterObjects() : ObjectCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new ObjectCollection(
            IterableHelper::filterByValueType(
                TypeCollectionHelper::toArray($this), Constants::PHP_TYPE_OBJECT
            )
        );
    }
}