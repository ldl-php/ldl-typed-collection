<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Validators\IntegerValidator;
use LDL\Validators\StringValidator;

class StrintegerCollection extends AbstractCollection implements HasAppendValueValidatorChainInterface
{
    use AppendValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->appendMany([
                new StringValidator(),
                new IntegerValidator()
            ])
            ->lock();
    }
}