<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Unshift;

use LDL\Framework\Base\Contracts\LockableObjectInterface;
use LDL\Framework\Base\Exception\LockingException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\HasKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface;

trait UnshiftTrait
{
    public function unshift($item, $key = null): CollectionInterface
    {
        if($this instanceof LockableObjectInterface && $this->isLocked()){
            throw new LockingException(sprintf('Can not call %s on a locked collection', __METHOD__));
        }

        $key = $key ?? 0;

        if($this instanceof HasKeyValidatorChainInterface){
            $this->getKeyValidatorChain()->validate($this, $item, $key);
        }

        if($this instanceof HasValueValidatorChainInterface){
            $this->getValueValidatorChain()->validate($this, $item, $key);
        }

        $this->first = $key;

        if(null === $this->last) {
            $this->last = $key;
        }

        if(is_string($key)){
            $this->items = [$key => $item] + $this->items;
            return $this;
        }

        $result = [$key=>$item];

        array_walk($this->items, static function($v, $k) use($result){
            if(is_int($k)){
                ++$k;
            }

            $result[$k] = $v;
        });

        $this->items = $result;

        return $this;
    }

}