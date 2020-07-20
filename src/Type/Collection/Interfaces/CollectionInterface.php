<?php

namespace LDL\Type\Collection\Interfaces;

interface CollectionInterface extends \Countable, \Iterator, \ArrayAccess
{

    /**
     * Validate the item to be added to the collection
     *
     * @param $item
     * @return mixed
     *
     * @throws \Exception
     */
    public function validateItem($item) : void;

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
}