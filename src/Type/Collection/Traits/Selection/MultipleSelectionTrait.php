<?php declare(strict_types=1);

/**
 * This trait applies the MultipleSelectionInterface so you can just easily use it in your class.
 *
 * @see \LDL\Type\Collection\Interfaces\Selection\MultipleSelectionInterface
 */

namespace LDL\Type\Collection\Traits\Selection;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Exception\CollectionKeyException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Selection\MultipleSelectionInterface;

trait MultipleSelectionTrait
{
    use SelectionLockingTrait;

    /**
     * @var array
     */
    private $__multiSelectionSelected = [];

    /**
     * @var int
     */
    private $__multiSelectionCountSelected=0;

    public function select($key) : MultipleSelectionInterface
    {
        $this->__multiSelectionCountSelected++;

        $this->_validateLockedSelection();

        $keys = is_scalar($key) ? [$key] : $key;

        if(!is_iterable($keys)){
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

    public function selectAll() : MultipleSelectionInterface
    {
        $this->__multiSelectionSelected = $this->keys();
        return $this;
    }

    public function getSelectedItems() : MultipleSelectionInterface
    {
        /**
         * @var CollectionInterface $collection
         */
        $collection = clone($this);
        $isAbstractCollection = $collection instanceof AbstractCollection;

        if($isAbstractCollection){
            $collection->disableValidations();
        }

        $collection->truncate();

        foreach($this as $key => $value){
            if(array_key_exists($key, $this->__multiSelectionSelected)){
                $collection->append($value, $key);
            }
        }

        if($isAbstractCollection){
            $collection->enableValidations();
        }

        return $collection;
    }

    public function getSelectedCount() : int
    {
        return $this->__multiSelectionCountSelected;
    }

    public function getSelectedKeys(): array
    {
        return array_keys($this->__multiSelectionSelected);
    }

    public function truncateToSelected() : MultipleSelectionInterface
    {
        $this->_validateLockedSelection();

        foreach($this as $key => $value){
            if(false === array_key_exists($key, $this->__multiSelectionSelected)){
                $this->offsetUnset($key);
            }
        }

        return $this;
    }

    public function removeSelection() : MultipleSelectionInterface
    {
        $this->_validateLockedSelection();

        $this->__multiSelectionCountSelected = 0;
        $this->__multiSelectionSelected = [];

        return $this;
    }

    public function hasSelection() : bool
    {
        return $this->getSelectedCount() > 0;
    }

}