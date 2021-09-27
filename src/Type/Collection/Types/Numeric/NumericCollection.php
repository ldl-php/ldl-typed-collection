<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Numeric;

use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Types\Double\FilterDoubleCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Integer\FilterIntegerCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Number\FilterUniqueNumberCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Number\FilterUnsignedNumberCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Types\Numeric\Traits\ToNumericPrimitiveArrayTrait;
use LDL\Validators\Chain\OrValidatorChain;
use LDL\Validators\NumericValidator;

final class NumericCollection extends AbstractTypedCollection implements HasAppendValueValidatorChainInterface, ToPrimitiveArrayInterface
{
    use AppendValueValidatorChainTrait;
    use FilterDoubleCollectionInterfaceTrait;
    use FilterIntegerCollectionInterfaceTrait;
    use FilterUniqueNumberCollectionInterfaceTrait;
    use FilterUnsignedNumberCollectionInterfaceTrait;
    use ToNumericPrimitiveArrayTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain(OrValidatorChain::class)
            ->getChainItems()
            ->append(new NumericValidator())
            ->lock();

        parent::__construct($items);
    }

}