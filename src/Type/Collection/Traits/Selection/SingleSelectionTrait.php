<?php declare(strict_types=1);

/**
 * This trait applies the SingleSelectionInterface so you can just easily use it in your class.
 * @see \LDL\Type\Collection\Interfaces\Selection\SingleSelectionInterface
 */

namespace LDL\Type\Collection\Traits\Selection;

use LDL\Type\Collection\Exception\CollectionKeyException;
use LDL\Framework\Base\Exception\LockingException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Selection\SingleSelectionInterface;

trait SingleSelectionTrait
{
    use SelectionLockingTrait;

    /**
     * @var number|string|null
     */
    private $__selectedKey;

    public function select($key) : SingleSelectionInterface
    {
        $this->_validateLockedSelection();

        /**
         * @var CollectionInterface $_this
         */
        $_this = $this;

        if($this->__selectionLocked){
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

        $this->__selectedKey = $key;

        return $_this;
    }

    public function getSelectedItem()
    {
        return $this->offsetGet($this->__selectedKey);
    }

    public function getSelectedKey()
    {
        return $this->__selectedKey;
    }

}