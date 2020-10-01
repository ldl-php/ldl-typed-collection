<?php declare(strict_types=1);

namespace LDL\Type\Collection;

use LDL\Type\Collection\Interfaces\Validation\HasKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasValidatorChainInterface;
use LDL\Type\Collection\Traits\CollectionTrait;

abstract class AbstractCollection implements Interfaces\CollectionInterface
{
    use CollectionTrait;

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
        $key = $key ?? $this->count;

        $this->validateKey($key);

        if($this instanceof HasKeyValidatorChainInterface){
            $this->getKeyValidatorChain()->validate($this, $item, $key);
        }

        if($this instanceof HasValidatorChainInterface){
            $this->getValidatorChain()->validate($this, $item, $key);
        }

        $this->last = $key;

        if(null === $this->first){
            $this->first = $key;
        }

        $this->items[$key] = $item;
        $this->count++;

        return $this;
    }

}
