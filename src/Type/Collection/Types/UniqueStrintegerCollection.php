<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types;

use LDL\Framework\Base\Traits\LockableObjectInterfaceTrait;
use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendValidatorChainTrait;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Validators\IntegerValidator;
use LDL\Validators\StringValidator;

class UniqueStrintegerCollection extends AbstractCollection implements HasAppendValidatorChainInterface
{
    use LockableObjectInterfaceTrait;
    use AppendValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendValidatorChain()
            ->append(new StringValidator(false))
            ->append(new IntegerValidator(false))
            ->append(new UniqueValidator(true))
            ->lock();
    }
}