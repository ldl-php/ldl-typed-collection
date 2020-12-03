<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Number;

use LDL\Type\Collection\Types\Lockable\LockableCollection;

class NumberCollection extends LockableCollection
{
    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getValueValidatorChain()->append(new Validator\NumberValidator());
    }
}