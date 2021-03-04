<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\String;

use LDL\Framework\Base\Traits\LockableObjectInterfaceTrait;
use LDL\Type\Collection\Interfaces;
use LDL\Type\Collection\Types\Lockable\LockableCollection;

class StringCollection extends LockableCollection
{
    use LockableObjectInterfaceTrait;

    /**
     * @var ?string
     */
    private $imploded;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValueValidatorChain()
            ->append(new Validator\StringValidator(true))
            ->lock();
    }

    public function implode(string $separator=',') : string
    {
        if(null !== $this->imploded){
            return $this->imploded;
        }

        return implode($separator, \iterator_to_array($this));
    }

    public function append($item, $key = null) : Interfaces\CollectionInterface
    {
        $this->imploded = null;
        return parent::append($item, $key);
    }

    public function remove($offset) : Interfaces\CollectionInterface
    {
        $this->imploded = null;
        return parent::remove($offset);
    }

    public function toUnique(): UniqueStringCollection
    {
        return new UniqueStringCollection(array_keys(array_flip(\iterator_to_array($this))));
    }
}