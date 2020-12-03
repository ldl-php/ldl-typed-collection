<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\String;

use LDL\Type\Collection\Traits\Locking\LockedCollectionTrait;
use LDL\Type\Collection\Types\Lockable\LockableCollection;

class StringCollection extends LockableCollection
{
    use LockedCollectionTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValueValidatorChain()
            ->append(new Validator\StringValidator(true))
            ->lock();
    }
}