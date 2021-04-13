<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types;

use LDL\Framework\Base\Traits\LockableObjectInterfaceTrait;
use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Validators\IntegerValidator;
use LDL\Validators\StringValidator;

class UniqueStrintegerCollection extends AbstractCollection implements HasAppendValueValidatorChainInterface
{
    use LockableObjectInterfaceTrait;
    use AppendValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendValueValidatorChain()
            ->append(new StringValidator(false))
            ->append(new IntegerValidator(false))
            ->append(new UniqueValidator(true))
            ->lock();
    }
}