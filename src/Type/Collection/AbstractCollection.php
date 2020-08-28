<?php declare(strict_types=1);

namespace LDL\Type\Collection;

abstract class AbstractCollection implements Interfaces\CollectionInterface
{
    /**
     * @var int
     */
    private $count = 0;

    /**
     * @var array
     */
    private $items = [];

    public function __construct(iterable $items=null)
    {
        if(null === $items){
            return;
        }

        foreach($items as $item){
            $this->append($item);
        }
    }

    public function append($item, $key=null) : Interfaces\CollectionInterface
    {
        $this->validateItem($item);

        $this->items[$key ?? $this->count()] = $item;
        $this->count++;

        return $this;
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

    public function offsetExists ($offset) : bool
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet($offset)
    {
        if(!$this->offsetExists($offset)){
            $msg = "Offset \"$offset\" does not exist";
            throw new Exception\UndefinedOffsetException($msg);
        }

        return $this->items[$offset];
    }

    public function offsetSet ($offset, $value) : void
    {
        try{

            $this->offsetGet($offset);
            $this->validateItem($value);
            $this->items[$offset] = $value;

        }catch(Exception\UndefinedOffsetException $e){

            $this->append($value, $offset);

        }
    }

    public function offsetUnset ($offset) : void
    {
        $this->offsetGet($offset);
        unset($this->items[$offset]);
        $this->count--;
    }

    public function keys() : array
    {
        return array_keys($this->items);
    }
}
