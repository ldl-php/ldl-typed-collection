<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object;

use LDL\Type\Collection\Types\Lockable\LockableCollection;

class ObjectCollection extends LockableCollection
{
    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getValidatorChain()
            ->append(new Validator\ObjectValidator());
    }
}