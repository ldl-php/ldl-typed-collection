<?php declare(strict_types=1);

namespace LDL\Type\Collection;

use LDL\Type\Collection\Interfaces\Validation\HasKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Traits\CollectionTrait;
use LDL\Type\Collection\Validator\ValidatorChainInterface;

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
            /**
             * @var ValidatorChainInterface $keyChain
             */
            $keyChain = $this->getKeyValidatorChain()
                ->filterByInterface(AppendItemValidatorInterface::class);

            $keyChain->validate($this, $item, $key);
        }

        if($this instanceof HasValidatorChainInterface){
            /**
             * @var ValidatorChainInterface $valueChain
             */
            $valueChain = $this->getValidatorChain()
                ->filterByInterface(AppendItemValidatorInterface::class);

            $valueChain->validate($this, $item, $key);
        }

        if(null === $this->first){
            $this->first = $key;
        }

        $this->last = $key;

        $this->items[$key] = $item;
        $this->count++;

        return $this;
    }

}
