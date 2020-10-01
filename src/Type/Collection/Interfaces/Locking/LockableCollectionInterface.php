<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Locking;

use LDL\Framework\Base\Contracts\LockableObjectInterface;
use LDL\Type\Collection\Exception\EmptyCollectionException;
use LDL\Type\Collection\Interfaces\CollectionInterface;

interface LockableCollectionInterface extends LockableObjectInterface {
    /**
     * Locks the collection, any other attempt to add or remove an item to this collection will be followed
     * by an exception.
     *
     * @throws EmptyCollectionException if the collection is empty
     * @return CollectionInterface
     */
    public function lock() : CollectionInterface;
}