<?php declare(strict_types=1);

/**
 * This trait applies the LockableCollectionInterface so you can just easily use it in your class.
 *
 * @see \LDL\Type\Collection\Interfaces\Locking\LockableCollectionInterface
 */

namespace LDL\Type\Collection\Traits\Locking;

use LDL\Type\Collection\Interfaces\CollectionInterface;

trait LockedCollectionTrait
{
    private $__isLocked = false;

    public function lock() : CollectionInterface
    {
        $this->__isLocked = true;

        return $this;
    }

    public function isLocked(): bool
    {
        return $this->__isLocked;
    }
}
