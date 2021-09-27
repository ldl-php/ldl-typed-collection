<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Integer;

use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Types\Integer\FilterUniqueIntegerCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Types\Integer\Traits\ToIntegerPrimitiveArrayTrait;
use LDL\Validators\IntegerValidator;

final class UnsignedIntegerCollection extends AbstractTypedCollection implements HasAppendValueValidatorChainInterface, ToPrimitiveArrayInterface
{
    use AppendValueValidatorChainTrait;
    use FilterUniqueIntegerCollectionInterfaceTrait;
    use ToIntegerPrimitiveArrayTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->append(new IntegerValidator(false,null,true))
            ->lock();

        parent::__construct($items);
    }

}