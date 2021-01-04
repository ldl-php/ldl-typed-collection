<?php declare(strict_types=1);

/**
 * This trait contains common functionality that can be applied to any collection
 */

namespace LDL\Type\Collection\Traits;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Exception\CollectionKeyException;
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

    //<editor-fold desc="CollectionInterface methods">
    public function getFirst()
    {
        if(null === $this->last) {
            $msg = 'Could not obtain first item since this collection is empty';
            throw new TypedCollectionException($msg);
        }

        return $this->items[$this->first];
    }

    public function getFirstKey()
    {
        return $this->first;
    }

    public function getLast()
    {
        if(null === $this->last) {
            $msg = 'Could not obtain last item since this collection is empty';
            throw new TypedCollectionException($msg);
        }

        return $this->items[$this->last];
    }

    public function getLastKey()
    {
        return $this->last;
    }

    public function isEmpty() : bool
    {
        return 0 === $this->count;
    }

    public function hasKey($key) : bool
    {
        return $this->offsetExists($key);
    }

    public function filterByKeys(iterable $keys) : CollectionInterface
    {
        /**
         * @var CollectionInterface $self
         */
        $self = clone($this);
        $self->truncate();
        $isAbstractCollection = $self instanceof AbstractCollection;

        if($isAbstractCollection){
            $self->disableValidations();
        }

        $keys = is_array($keys) ? $keys : \iterator_to_array($keys);

        foreach($this->items as $k => $v){
            if(!in_array($k, $keys, true)){
                continue;
            }
            $self->append($v, $k);
        }

        if($isAbstractCollection){
            $self->enableValidations();
        }

        return $self;
    }

    public function filterByKey(string $key)
    {
        return $this->filterByKeys([$key])->getFirst();
    }

    public function filterByKeyRegex(string $regex) : CollectionInterface
    {
        $regex = preg_quote($regex, '#');

        $self = clone($this);
        $self->truncate();

        foreach($this as $key=>$value){
            if(preg_match($key, $regex)){
                $self->append($value, $key);
            }
        }

        return $self;
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

    public function appendMany(iterable $items, bool $useKey=false) : CollectionInterface
    {
        foreach ($items as $key => $value) {
            $this->append($value, $useKey ? $key : null);
        }

        return $this;
    }
    //</editor-fold>

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
        if(null !== $offset && !is_scalar($offset)){
            throw new CollectionKeyException('Keys can be only of scalar type');
        }

        return array_key_exists($offset, $this->items);
    }

    public function offsetGet($offset)
    {
        if(!is_scalar($offset)){
            throw new CollectionKeyException('Keys can be only of scalar type');
        }

        if(!$this->offsetExists($offset)){
            $msg = "Offset \"$offset\" does not exist";
            throw new UndefinedOffsetException($msg);
        }

        return $this->items[$offset];
    }

    public function offsetSet($offset, $value) : void
    {
        if(null !== $offset && !is_scalar($offset)){
            throw new CollectionKeyException('Keys can be only of scalar type');
        }

        $this->replace($value, $offset);
    }

    public function offsetUnset($offset) : void
    {
        if(!is_scalar($offset)){
            throw new CollectionKeyException('Keys can be only of scalar type');
        }

        $this->remove($offset);
    }
    //</editor-fold>

}