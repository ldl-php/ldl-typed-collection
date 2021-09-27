<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types\String;

use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\String\StringCollection;

trait FilterStringCollectionInterfaceTrait
{
    /**
     * Filters all values which are strings inside a collection and returns a StringCollection.
     *
     * If there are objects within your collection which have the __toString method, said
     * objects will be casted to string.
     *
     * NOTE: This accessory method *filters* meaning that the numbers of elements will probably
     * not be the same amount as the amount of elements from the original collection.
     *
     * @return StringCollection
     */
    public function filterStrings() : StringCollection
    {
        ClassHelper::mustHaveInterface(__CLASS__,TypedCollectionInterface::class);

        return new StringCollection(
            IterableHelper::filterByValueType($this,Constants::PHP_TYPE_STRING)
        );
    }
}