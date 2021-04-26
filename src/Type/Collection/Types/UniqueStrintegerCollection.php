<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types;

use LDL\Framework\Base\Traits\LockableObjectInterfaceTrait;
use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Validators\Chain\AndValidatorChain;
use LDL\Validators\Chain\OrValidatorChain;
use LDL\Validators\IntegerValidator;
use LDL\Validators\StringValidator;

class UniqueStrintegerCollection extends AbstractCollection implements HasAppendValueValidatorChainInterface
{
    use LockableObjectInterfaceTrait;
    use AppendValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendValueValidatorChain(OrValidatorChain::class)
            ->append(new StringValidator())
            ->append(new IntegerValidator())
            ->append(new AndValidatorChain([new UniqueValidator()]))
            ->lock();
    }
}