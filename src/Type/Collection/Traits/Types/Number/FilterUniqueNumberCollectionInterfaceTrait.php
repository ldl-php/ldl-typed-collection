<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Number;

use LDL\Framework\Base\Constants;
use LDL\Framework\Base\Contracts\Type\ToNumericInterface;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\Helper\UniqueTypeHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Numeric\UniqueNumericCollection;

trait FilterUniqueNumberCollectionInterfaceTrait
{
    /**
     * Filters all values which are numbers (doubles or integers) inside a collection
     * and returns a UniqueNumberCollection (with no duplicate values).
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @param bool $preferObjects
     * @return UniqueNumericCollection
     */
    public function filterUniqueNumbers(bool $preferObjects=true) : UniqueNumericCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new UniqueNumericCollection(
            UniqueTypeHelper::unique(
                IterableHelper::filterByValueType($this, Constants::LDL_TYPE_NUMERIC),
                ToNumericInterface::class,
                ToNumericInterface::TO_NUMERIC_TYPE_METHOD_NAME,
                $preferObjects
            )
        );
    }
}