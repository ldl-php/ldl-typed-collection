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
     * @throws \Exception
     *
     * @return CollectionInterface
     */
    public function append($item, $key = null) : CollectionInterface;

    /**
     * If the key already exists, it will be replaced, if the key does not exists
     * it will be appended to the collection.
     *
     * @param $item
     * @param $key
     * @throws \Exception if the value does not exist
     * @return CollectionInterface
     */
    public function replace($item, $key) : CollectionInterface;

    /**
     * Return associated indices
     *
     * @return array
     */
    public function keys() : array;

    /**
     * Check if a key exists
     *
     * @param number|string $key
     * @return bool
     */
    public function hasKey($key) : bool;

    /**
     * Syntax sugar for unset($collection[$key]); or $collection->offsetUnset($key);
     *
     * @param $key
     * @return void
     */
    public function remove($key) : void;

    /**
     * Remove last appended item
     *
     * @return void
     */
    public function removeLast() : void;

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