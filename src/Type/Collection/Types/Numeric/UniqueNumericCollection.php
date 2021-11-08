<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Numeric;

use LDL\Framework\Base\Contracts\Type\ToNumericInterface;
use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Types\Double\FilterDoubleCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Integer\FilterIntegerCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Number\FilterUnsignedNumberCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Types\Numeric\Traits\ToNumericPrimitiveArrayTrait;
use LDL\Type\Collection\Validator\UniqueTypeValidator;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Validators\NumericValidator;

final class UniqueNumericCollection extends AbstractTypedCollection implements ToPrimitiveArrayInterface
{
    use FilterUnsignedNumberCollectionInterfaceTrait;
    use FilterIntegerCollectionInterfaceTrait;
    use FilterDoubleCollectionInterfaceTrait;
    use ToNumericPrimitiveArrayTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->appendMany([
                new NumericValidator(),
                new UniqueTypeValidator('toNumeric')
            ])
            ->lock();

        parent::__construct($items);
    }
}