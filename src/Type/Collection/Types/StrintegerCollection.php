<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendValidatorChainTrait;
use LDL\Validators\IntegerValidator;
use LDL\Validators\StringValidator;

class StrintegerCollection extends AbstractCollection implements HasAppendValidatorChainInterface
{
    use AppendValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendValidatorChain()
            ->append(new StringValidator(false))
            ->append(new IntegerValidator(false))
            ->lock();
    }
}