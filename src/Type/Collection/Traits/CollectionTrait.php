<?php declare(strict_types=1);

/**
 * This trait contains common functionality that can be applied to any collection
 */

namespace LDL\Type\Collection\Traits;

use LDL\Type\Collection\Exception\CollectionKeyException;
use LDL\Type\Collection\Exception\TypedCollectionException;
use LDL\Type\Collection\Exception\UndefinedOffsetException;
use LDL\Type\Collection\Interfaces\Validation\HasValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\RemoveItemValidatorInterface;
use LDL\Type\Collection\Validator\ValidatorChainInterface;

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

    public function count() : int
    {
        return $this->count;
    }

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

    public function hasKey($key) : bool
    {
        return $this->offsetExists($key);
    }

    public function remove($key)
    {
        $this->offsetUnset($key);
    }

    public function removeLast()
    {
        $this->offsetUnset($this->last);
    }

    public function offsetExists($offset) : bool
    {
        if(!is_scalar($offset)){
            throw new CollectionKeyException('Key must be of scalar type');
        }

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
        $this->append($offset, $value);
    }

    public function offsetUnset($offset) : void
    {
        $item = $this->offsetGet($offset);

        if($this instanceof HasValidatorChainInterface){

            /**
             * @var ValidatorChainInterface $validators
             */
            $validators = $this->getValidatorChain()
                ->filterByInterface(
                RemoveItemValidatorInterface::class
            );

            $validators->validate($this, $item, $offset);
        }

        unset($this->items[$offset]);
        $this->count--;

        $keys = $this->keys();
        $lastKey = count($keys) - 1;
        $this->last = $keys[$lastKey > 0 ? $lastKey : 0];
    }

    public function keys() : array
    {
        return array_keys($this->items);
    }

    public function validateKey($key=null) : void
    {
        /**
         * Scalars also include booleans, but I'm not in charge to say you shouldn't use them as keys ¯\_(ツ)_/¯
         */
        if(is_scalar($key)){
            return;
        }

        if(
            is_object($key) &&
            in_array('__tostring', array_map('strtolower', get_class_methods($key)), true)
        ){
            $key = sprintf('%s', $key);
        }

        $msg = sprintf(
            'Item key for collection must be of type scalar, "%s" was given',
            gettype($key)
        );

        throw new CollectionKeyException($msg);
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
}