<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Integer;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Integer\IntegerCollection;

trait FilterIntegerCollectionInterfaceTrait
{
    /**
     * Filters all values which are integers inside a collection and returns an IntegerCollection
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return IntegerCollection
     */
    public function filterIntegers() : IntegerCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new IntegerCollection(
            IterableHelper::filterByValueType($this, Constants::PHP_TYPE_INTEGER)
        );
    }
}