<?php declare(strict_types=1);

/**
 * This trait contains common functionality that can be applied to any collection
 */

namespace LDL\Type\Collection\Traits;

use LDL\Type\Collection\Exception\TypedCollectionException;
use LDL\Type\Collection\Exception\UndefinedOffsetException;
use LDL\Type\Collection\Interfaces\CollectionInterface;

trait CollectionTrait
{
    /**
     * Maintains the count of elements inside the collection
     * @var int
     */
    private $count = 0;

    /**
     * Holds all items
     * @var array
     */
    private $items = [];

    /**
     * Holds the key of the last appended item
     * @var number|string
     */
    private $last;

    /**
     * Holds the key of the first appended item
     * @var number|string
     */
    private $first;

    public function getFirst()
    {
        if(null === $this->last) {
            $msg = 'Could not obtain first item since this collection is empty';
            throw new TypedCollectionException($msg);
        }

        return $this->items[$this->first];
    }

    public function getLast()
    {
        if(null === $this->last) {
            $msg = 'Could not obtain last item since this collection is empty';
            throw new TypedCollectionException($msg);
        }

        return $this->items[$this->last];
    }

    public function isEmpty() : bool
    {
        return 0 === $this->count;
    }

    public function hasKey($key) : bool
    {
        return $this->offsetExists($key);
    }

    public function filterByKeys(array $keys) : CollectionInterface
    {
        /**
         * @var CollectionInterface $self
         */
        $self = clone($this);
        $self->items = [];

        $first = true;

        $k = null;

        foreach($this->items as $k=>$v){
            if(!in_array($k, $keys, true)) {
                continue;
            }

            if($first){
                $self->first = $k;
                $first = false;
            }

            $self->items[$k] = $v;
        }

        $self->last = $k;

        return $self;
    }

    public function filterByKey(string $key)
    {
        return $this->filterByKeys([$key])->getFirst();
    }

    public function filterByKeyRegex(string $regex) : CollectionInterface
    {
        $regex = preg_quote($regex, '#');

        /**
         * @var CollectionInterface $collection
         */
        $collection = clone($this);

        foreach($this as $key=>$value){
            if(preg_match($key, $regex)){
                $collection->append($value, $key);
            }
        }

        if(count($collection) === 0){
            $msg = "No items could be found by key matching regex: $regex";
            throw new \LogicException($msg);
        }

        return $collection;
    }

    public function removeLast() : CollectionInterface
    {
        $this->remove($this->last);
        return $this;
    }

    public function keys() : array
    {
        return array_keys($this->items);
    }

    public function hasValue($value) : bool
    {
        foreach($this as $val){
            if($val === $value){
                return true;
            }
        }

        return false;
    }

    public function truncate() : CollectionInterface
    {
        while(false === $this->isEmpty()){
            $this->removeLast();
        }

        return $this;
    }

    //<editor-fold desc="\Countable Methods">
    public function count() : int
    {
        return $this->count;
    }
    //</editor-fold>

    //<editor-fold desc="\Iterator Methods">
    public function rewind() : void
    {
        reset($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function next()
    {
        return next($this->items);
    }

    public function valid() : bool
    {
        $key = key($this->items);
        return ($key !== null && $key !== false);
    }

    public function current()
    {
        return current($this->items);
    }
    //<editor-fold>

    //<editor-fold desc="\ArrayAccess Methods">
    public function offsetExists($offset) : bool
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet($offset)
    {
        if(!$this->offsetExists($offset)){
            $msg = "Offset \"$offset\" does not exist";
            throw new UndefinedOffsetException($msg);
        }

        return $this->items[$offset];
    }

    public function offsetSet($offset, $value) : void
    {
        $this->replace($value, $offset);
    }

    public function offsetUnset($offset) : void
    {
        $this->remove($offset);
    }
    //</editor-fold>

}