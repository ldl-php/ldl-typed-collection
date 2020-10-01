<?php declare(strict_types=1);

/**
 * WARNING: This interface must never be used alone by itself, you should use one of
 * SingleSelectionInterface or MultipleSelectionInterface, depending on what you need.
 *
 * @see \LDL\Type\Collection\Interfaces\SingleSelectionInterface
 * @see \LDL\Type\Collection\Interfaces\MultipleSelectionInterface
 */

namespace LDL\Type\Collection\Interfaces\Selection;

use LDL\Type\Collection\Exception\CollectionKeyException;
use LDL\Type\Collection\Exception\EmptyCollectionException;
use LDL\Framework\Base\Exception\LockingException;
use LDL\Type\Collection\Exception\UndefinedOffsetException;
use LDL\Type\Collection\Interfaces\CollectionInterface;

interface PrivateSelectableInterface {
    /**
     * Selects an item in the collection by it's storage key and marks it as "selected"
     * This is useful when you have object collections in which you have many objects inside the collection
     * but only one is supposed to be used from this entire collection.
     *
     * Example, you have a collection of adapters but only one adapter is the one that must be used throughout
     * a request workflow.
     *
     * @param mixed $key
     *
     * @throws LockingException if the selection of items has been locked down
     * @throws EmptyCollectionException if the collection is empty
     * @throws CollectionKeyException if the provided key is not of scalar type
     * @throws UndefinedOffsetException if the key to be selected does not exists
     * @return CollectionInterface
     */
    public function select($key) : CollectionInterface;

    /**
     * Locks selection, avoid further elements to be selected in this collection
     *
     * @throws LockingException if the selection was already locked
     * @return CollectionInterface
     */
    public function lockSelection() : CollectionInterface;

    /**
     * Tells the user if item selection is locked or not
     *
     * @see self::select (second parameter $lockSelected)
     * @return bool
     */
    public function isSelectionLocked() : bool;

}