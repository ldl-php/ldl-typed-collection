<?php declare(strict_types=1);

/**
 * This trait applies the MultipleSelectionInterface so you can just easily use it in your class.
 *
 * @see \LDL\Type\Collection\Interfaces\Selection\MultipleSelectionInterface
 */

namespace LDL\Type\Collection\Traits\Selection;

use LDL\Framework\Base\Exception\LockingException;
use LDL\Type\Collection\Interfaces\CollectionInterface;

trait PrivateSelectionLockingTrait
{

    /**
     * @var bool
     */
    private $__selectionLocked = false;

    private function _validateLockedSelection(){
        if(false === $this->__selectionLocked) {
            return;
        }

        $msg = 'Selection of items has been locked, can not select more items in this collection';
        throw new LockingException($msg);
    }

    public function lockSelection() : CollectionInterface
    {
        $this->_validateLockedSelection();
        $this->__selectionLocked = true;

        return $this;
    }

    public function isSelectionLocked() : bool
    {
        return $this->__selectionLocked;
    }

}