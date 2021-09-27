<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Double;

use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Types\Double\FilterUnsignedDoubleCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Types\Double\Traits\ToDoublePrimitiveArrayTrait;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Validators\DoubleValidator;

final class UniqueDoubleCollection extends AbstractTypedCollection implements HasAppendValueValidatorChainInterface, ToPrimitiveArrayInterface
{
    use AppendValueValidatorChainTrait;
    use FilterUnsignedDoubleCollectionInterfaceTrait;
    use ToDoublePrimitiveArrayTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->appendMany([
                new DoubleValidator(),
                new UniqueValidator()
            ])
            ->lock();

        parent::__construct($items);
    }
}