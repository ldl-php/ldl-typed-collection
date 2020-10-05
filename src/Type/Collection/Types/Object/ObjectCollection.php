<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object;

use LDL\Type\Collection\Traits\Filter\FilterByInterfaceTrait;
use LDL\Type\Collection\Types\Lockable\LockableCollection;
use LDL\Type\Collection\Types\Object\Filter\FilterByInterface;

class ObjectCollection extends LockableCollection implements FilterByInterface
{
    use FilterByInterfaceTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getValidatorChain()
            ->append(new Validator\ObjectItemValidator());
    }
}