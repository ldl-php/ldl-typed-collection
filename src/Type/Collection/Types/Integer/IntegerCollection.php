<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Integer;

use LDL\Type\Collection\Types\Lockable\LockableCollection;

class IntegerCollection extends LockableCollection
{
    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getValidatorChain()->append(new Validator\IntegerItemValidator());
    }
}