<?php declare(strict_types=1);

/**
 * This trait applies the MultipleSelectionInterface so you can just easily use it in your class.
 *
 * @see \LDL\Type\Collection\Interfaces\Selection\MultipleSelectionInterface
 */

namespace LDL\Type\Collection\Traits\Selection;

use LDL\Type\Collection\Exception\CollectionKeyException;
use LDL\Type\Collection\Exception\ItemSelectionException;
use LDL\Type\Collection\Interfaces\CollectionInterface;

trait MultipleSelectionTrait
{
    use PrivateSelectionLockingTrait;

    /**
     * @var array
     */
    private $__selected = [];

    public function select($key) : CollectionInterface
    {
        $this->_validateLockedSelection();

        if(!is_scalar($key)){
            throw new CollectionKeyException('Selection key must be of scalar type');
        }

        /**
         * If offset does not exists, it will throw an UndefinedOffsetException
         */
        $this->offsetGet($key);

        $this->__selected[$key] = true;

        return $this;
    }

    public function getSelectedItems() : CollectionInterface
    {
        if(null === $this->__selected){
            throw new ItemSelectionException('No item was selected');
        }

        /**
         * @var CollectionInterface $collection
         */
        $collection = new static();

        foreach($this as $key => $value){
            if(array_key_exists($key, $this->__selected)){
                $collection->append($key, $value);
            }
        }

        return $collection;
    }

    public function getSelectedKeys(): array
    {
        return array_keys($this->__selected);
    }

}