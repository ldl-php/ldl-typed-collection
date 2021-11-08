<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Numeric;

use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Types\Number\FilterUniqueNumberCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Types\Numeric\Traits\ToNumericPrimitiveArrayTrait;
use LDL\Validators\NumericValidator;

final class UnsignedNumericCollection extends AbstractTypedCollection implements ToPrimitiveArrayInterface
{
    use AppendValueValidatorChainTrait;
    use FilterUniqueNumberCollectionInterfaceTrait;
    use ToNumericPrimitiveArrayTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->append(new NumericValidator(false,null,true))
            ->lock();

        parent::__construct($items);
    }

}