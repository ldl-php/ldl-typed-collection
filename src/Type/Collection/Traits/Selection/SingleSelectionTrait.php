<?php declare(strict_types=1);

/**
 * This trait applies the SingleSelectionInterface so you can just easily use it in your class.
 * @see \LDL\Type\Collection\Interfaces\Selection\SingleSelectionInterface
 */

namespace LDL\Type\Collection\Traits\Selection;

use LDL\Type\Collection\Exception\CollectionKeyException;
use LDL\Framework\Base\Exception\LockingException;
use LDL\Type\Collection\Interfaces\Selection\SelectionLockingInterface;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Interfaces\Selection\SingleSelectionInterface;

trait SingleSelectionTrait
{
    /**
     * @var number|string|null
     */
    private $_tSelectedKey;

    /**
     * @var bool
     */
    private $_tSelectionLocked = false;

    public function select($key) : SingleSelectionInterface
    {
        $this->_validateLockedSelection();

        /**
         * @var TypedCollectionInterface $_this
         */
        $_this = $this;

        if($this->_tSelectionLocked){
            $msg = 'Selection of items has been locked, can not select more items in this collection';
            throw new LockingException($msg);
        }

        if(!is_scalar($key)){
            throw new CollectionKeyException('Selection key must be of scalar type');
        }

        /**
         * If offset does not exists, it will throw an UndefinedOffsetException
         */
        $this->offsetGet($key);

        $this->_tSelectedKey = $key;

        return $_this;
    }

    public function getSelectedItem()
    {
        return $this->offsetGet($this->_tSelectedKey);
    }

    public function getSelectedKey()
    {
        return $this->_tSelectedKey;
    }

    public function hasSelection() : bool
    {
        return $this->_tSelectedKey !== null;
    }

    private function _validateLockedSelection() : void
    {
        if(false === $this->_tSelectionLocked) {
            return;
        }

        $msg = 'Selection of items has been locked, can not select more items in this collection';
        throw new LockingException($msg);
    }

    public function lockSelection() : SelectionLockingInterface
    {
        $this->_validateLockedSelection();
        $this->_tSelectionLocked = true;

        return $this;
    }

    public function isSelectionLocked() : bool
    {
        return $this->_tSelectionLocked;
    }
}