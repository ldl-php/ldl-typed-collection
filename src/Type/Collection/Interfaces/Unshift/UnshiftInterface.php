<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Unshift;

use LDL\Type\Collection\TypedCollectionInterface;

interface UnshiftInterface
{

    /**
     * Prepends an element to the collection if the collection has numeric keys the
     * keys will be reordered, for example [0 => 'test', 1=>'test2'] then "unshifting" a value 'test3' will result in:
     * [0 => 'test3', 1=>'test', 2=>'test2']
     *
     * if the unshifted element has a string $key, then the key will be replaced, and the item will be first in the array
     *
     * @param mixed $item
     * @param string|int $key
     * @return TypedCollectionInterface
     * @throws \Exception
     */
    public function unshift($item, $key = null): TypedCollectionInterface;
}