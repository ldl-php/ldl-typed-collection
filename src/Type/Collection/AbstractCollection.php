<?php declare(strict_types=1);

namespace LDL\Type\Collection;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\RemoveItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\HasKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface;
use LDL\Type\Collection\Validator\ValidatorChainInterface;
use LDL\Type\Collection\Traits\CollectionTrait;

abstract class AbstractCollection implements Interfaces\CollectionInterface
{
    use CollectionTrait;

    protected $_validateValues =  true;

    protected $_validateKeys = true;

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

        $this->validateKey(AppendItemValidatorInterface::class, $item, $key);
        $this->validateValue(AppendItemValidatorInterface::class, $item, $key);

        if(null === $this->first){
            $this->first = $key;
        }

        $this->last = $key;

        $this->items[$key] = $item;
        $this->count++;

        return $this;
    }

    public function unshift($item, $key = null): CollectionInterface
    {
        $key = $key ?? 0;

        $this->validateKey(AppendItemValidatorInterface::class, $item, $key);
        $this->validateValue(AppendItemValidatorInterface::class, $item, $key);

        $this->first = $key;

        if(null === $this->last) {
            $this->last = $key;
        }

        if(is_string($key)){
            $this->items = [$key => $item] + $this->items;
            return $this;
        }

        $result = [$key => $item];

        array_walk($this->items, static function($v, $k) use($result){
            if(is_int($k)){
                ++$k;
            }

            $result[$k] = $v;
        });

        $this->items = $result;

        return $this;
    }

    public function remove($offset) : Interfaces\CollectionInterface
    {
        $item = $this->offsetGet($offset);
        $this->validateKey(RemoveItemValidatorInterface::class, $item, $offset);

        /**
         * This doesn't makes sense at first sight, but if you think about it in the lines of
         * the MinimumItemAmountValidator, then, it makes sense.
         *
         * @see MinimumAmountValidator
         */
        $this->validateValue(RemoveItemValidatorInterface::class, $item, $offset);

        unset($this->items[$offset]);
        $this->count--;

        $keys = $this->keys();
        $lastKey = count($keys);

        if(0 === $lastKey) {
            $this->last = null;
            return $this;
        }

        $this->last = $keys[$lastKey - 1];
        return $this;
    }

    public function replace($item, $key) : Interfaces\CollectionInterface
    {
        if(!$this->offsetExists($key)){
            return $this->append($item, $key);
        }

        $this->validateKey(AppendItemValidatorInterface::class, $item, $key);
        $this->validateValue(AppendItemValidatorInterface::class, $item, $key);

        $this->items[$key] = $item;

        return $this;
    }

    private function validateKey(string $interface, $item, $key) : void
    {
        if(!$this instanceof HasKeyValidatorChainInterface){
            return;
        }

        if(false === $this->_validateKeys){
            return;
        }

        /**
         * @var ValidatorChainInterface $keyChain
         */
        $keyChain = $this->getKeyValidatorChain()
            ->filterByInterface($interface);

        /**
         * Swap arguments around since key is supposed to be the value
         */
        $keyChain->validate($this, $item, $key);
    }

    private function validateValue(string $interface, $item, $key) : void
    {
        if(!$this instanceof HasValueValidatorChainInterface){
            return;
        }

        if(false === $this->_validateValues){
            return;
        }

        /**
         * @var HasValueValidatorChainInterface $valueChain
         */
        $valueChain = $this->getValueValidatorChain()
            ->filterByInterface($interface);

        $valueChain->validate($this, $item, $key);
    }

    protected function enableValueValidations() : self
    {
        $this->_validateValues = true;
        return $this;
    }

    protected function disableValueValidations() : self
    {
        $this->_validateValues = false;
        return $this;
    }

    protected function enableKeyValidations() : self
    {
        $this->_validateKeys = true;
        return $this;
    }

    protected function disableKeyValidations() : self
    {
        $this->_validateKeys = false;
        return $this;
    }

    protected function enableValidations() : self
    {
        $this->enableKeyValidations();
        return $this->enableValueValidations();
    }

    protected function disableValidations() : self
    {
        $this->disableKeyValidations();
        return $this->disableValueValidations();
    }

}
