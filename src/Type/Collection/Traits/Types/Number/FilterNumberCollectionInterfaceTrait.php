<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Number;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Numeric\NumericCollection;

trait FilterNumberCollectionInterfaceTrait
{
    /**
     * Filters all values which are numbers (doubles or integers) inside a collection
     * and returns a NumberCollection.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return NumericCollection
     */
    public function filterNumbers() : NumericCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new NumericCollection(
            IterableHelper::filterByValueType($this,Constants::LDL_TYPE_NUMERIC)
        );
    }
}