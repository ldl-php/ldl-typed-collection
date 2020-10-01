<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces;

use LDL\Type\Collection\Exception\TypedCollectionException;

interface CollectionInterface extends \Countable, \Iterator, \ArrayAccess
{
    /**
     * Append an element to the collection
     *
     * @param mixed $item
     * @param mixed $key
     *
     * @return CollectionInterface
     */
    public function append($item, $key = null) : CollectionInterface;

    /**
     * Return associated indices
     *
     * @return array
     */
    public function keys() : array;

    /**
     * Validates collection key element, it must ALWAYS validate for a scalar value
     *
     * @param $key
     */
    public function validateKey($key) : void;

    /**
     * Check if a key exists
     *
     * @param number|string $key
     * @return bool
     */
    public function hasKey($key) : bool;

    /**
     * Check if a value exists inside the collection, comparison should between the given value and the collection
     * items should be performed by using strict comparison
     *
     * @param $value
     * @return bool
     */
    public function hasValue($value) : bool;

    /**
     * Obtains the first element in the collection
     *
     * @throws TypedCollectionException if there are no elements inside the collection
     * @return mixed
     */
    public function getFirst();

    /**
     * Obtains the last element in the collection
     *
     * @throws TypedCollectionException if there are no elements inside the collection
     * @return mixed
     */
    public function getLast();

    /**
     * Syntactic sugar to determine if the collection is empty or not (since you could use $collection->count() === 0)
     * @return bool
     */
    public function isEmpty() : bool;
}