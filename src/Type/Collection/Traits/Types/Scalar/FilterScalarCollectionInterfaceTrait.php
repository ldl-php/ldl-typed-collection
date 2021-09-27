<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Integer;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Scalar\ScalarCollection;

trait FilterScalarCollectionInterfaceTrait
{
    /**
     * Filters all values which are scalars inside a collection and returns a ScalarCollection
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return ScalarCollection
     */
    public function filterScalars() : ScalarCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new ScalarCollection(
            IterableHelper::filterByValueType($this, Constants::LDL_TYPE_SCALAR)
        );
    }
}