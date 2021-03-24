<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Unshift;

use LDL\Framework\Base\Contracts\LockableObjectInterface;
use LDL\Framework\Base\Exception\LockingException;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValidatorChainInterface;

trait UnshiftTrait
{
    public function unshift($item, $key = null): TypedCollectionInterface
    {
        if($this instanceof LockableObjectInterface && $this->isLocked()){
            throw new LockingException(sprintf('Can not call %s on a locked collection', __METHOD__));
        }

        $key = $key ?? 0;

        if($this instanceof HasAppendKeyValidatorChainInterface){
            $this->getAppendKeyValidatorChain()->validate($this, $item, $key);
        }

        if($this instanceof HasAppendValidatorChainInterface){
            $this->getAppendValidatorChain()->validate($this, $item, $key);
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