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
    private $__multiSelectionSelected = [];

    /**
     * @var int
     */
    private $__multiSelectionCountSelected=0;

    /**
     * @param  mixed
     * @throws CollectionKeyException
     * @throws \LDL\Framework\Base\Exception\LockingException
     * @return CollectionInterface
     */
    public function select($key) : CollectionInterface
    {
        $this->__multiSelectionCountSelected++;

        $this->_validateLockedSelection();

        $keys = is_scalar($key) ? [$key] : $key;

        if(!is_array($keys)){
            $msg = sprintf('%s accepts only scalar or array values as key(s) to be selected', __METHOD__);
            throw new CollectionKeyException($msg);
        }

        foreach($keys as $k){
            /**
             * If offset does not exists, it will throw an UndefinedOffsetException
             */
            $this->offsetGet($k);

            $this->__multiSelectionSelected[$k] = true;
        }

        return $this;
    }

    /**
     * @return CollectionInterface
     * @throws ItemSelectionException
     */
    public function getSelectedItems() : CollectionInterface
    {
        if(0 === $this->__multiSelectionCountSelected){
            throw new ItemSelectionException('No items were selected');
        }

        /**
         * @var CollectionInterface $collection
         */
        $collection = clone($this);
        $collection->truncate();

        foreach($this as $key => $value){
            if(array_key_exists($key, $this->__multiSelectionSelected)){
                $collection->append($value, $key);
            }
        }

        return $collection;
    }

    public function getSelectedCount() : int
    {
        return $this->__multiSelectionCountSelected;
    }

    /**
     * @return array
     * @throws ItemSelectionException
     */
    public function getSelectedKeys(): array
    {
        if(0 === $this->__multiSelectionCountSelected){
            throw new ItemSelectionException('No items were selected');
        }

        return array_keys($this->__multiSelectionSelected);
    }

}