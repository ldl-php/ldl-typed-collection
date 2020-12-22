<?php declare(strict_types=1);

namespace LDL\Type\Collection\Exception;

use LDL\Type\Collection\Types\Lockable\LockableCollection;
use LDL\Type\Collection\Types\Object\Validator\InterfaceComplianceItemValidator;

class ExceptionCollection extends LockableCollection
{
    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValueValidatorChain()
            ->append(new InterfaceComplianceItemValidator(\Throwable::class));
    }
}