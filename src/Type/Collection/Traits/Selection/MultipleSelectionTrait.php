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

    /**
     * @param $key
     * @return CollectionInterface
     * @throws CollectionKeyException
     * @throws \LDL\Framework\Base\Exception\LockingException
     */
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

    /**
     * @return CollectionInterface
     * @throws ItemSelectionException
     */
    public function getSelectedItems() : CollectionInterface
    {
        if(null === $this->__selected){
            throw new ItemSelectionException('No items were selected');
        }

        /**
         * @var CollectionInterface $collection
         */
        $collection = clone($this);
        $collection->truncate();

        foreach($this as $key => $value){
            if(array_key_exists($key, $this->__selected)){
                $collection->append($value, $key);
            }
        }

        return $collection;
    }

    /**
     * @return array
     * @throws ItemSelectionException
     */
    public function getSelectedKeys(): array
    {
        if(null === $this->__selected){
            throw new ItemSelectionException('No items were selected');
        }

        return array_keys($this->__selected);
    }

}