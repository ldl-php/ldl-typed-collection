<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Number;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Validators\NumericValidator;

class NumberCollection extends AbstractCollection implements HasAppendValueValidatorChainInterface
{
    use AppendValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->append(new NumericValidator())
            ->lock();
    }
}