<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Numeric;

use LDL\Validators\NumericValidator;
use LDL\Validators\Chain\OrValidatorChain;
use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\NumericCollectionInterface;
use LDL\Type\Collection\Types\Numeric\Traits\ToNumericPrimitiveArrayTrait;
use LDL\Type\Collection\Traits\Types\Double\FilterDoubleCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Integer\FilterIntegerCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Number\FilterUniqueNumberCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Number\FilterUnsignedNumberCollectionInterfaceTrait;

final class NumericCollection extends AbstractTypedCollection implements NumericCollectionInterface
{
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