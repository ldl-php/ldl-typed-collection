<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\String;

use LDL\Type\Collection\Types\Lockable\LockableCollection;
use LDL\Type\Collection\Validator\UniqueValidator;

class UniqueStringCollection extends LockableCollection
{
    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValueValidatorChain()
            ->append(new Validator\StringValidator(true))
            ->append(new UniqueValidator(true))
            ->lock();
    }
}