<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\String;

use LDL\Framework\Base\Traits\LockableObjectInterfaceTrait;
use LDL\Type\Collection\Types\Lockable\LockableCollection;

class StringCollection extends LockableCollection
{
    use LockableObjectInterfaceTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValueValidatorChain()
            ->append(new Validator\StringValidator(true))
            ->lock();
    }
}