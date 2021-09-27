<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\Scalar;

use LDL\Framework\Base\Constants;
use LDL\Framework\Base\Contracts\Type\ToScalarInterface;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\Helper\UniqueTypeHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Scalar\UniqueScalarCollection;

trait FilterUniqueScalarCollectionInterfaceTrait
{
    /**
     * Filters all values which are scalars inside a collection and returns a UniqueScalarCollection
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @param bool $preferObjects
     * @return UniqueScalarCollection
     */
    public function filterUniqueScalars(bool $preferObjects=true) : UniqueScalarCollection
    {
        ClassHelper::mustHaveInterface(get_class($this), \Traversable::class);

        return new UniqueScalarCollection(
            UniqueTypeHelper::unique(
                IterableHelper::filterByValueType($this, Constants::LDL_TYPE_SCALAR),
                ToScalarInterface::class,
                ToScalarInterface::TO_SCALAR_TYPE_METHOD_NAME,
                $preferObjects
            )
        );
    }
}