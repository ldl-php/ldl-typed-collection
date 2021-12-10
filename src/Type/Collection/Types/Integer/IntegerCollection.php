<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Integer;

use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\IntegerCollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Types\Integer\FilterUniqueIntegerCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Integer\FilterUnsignedIntegerCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Types\Integer\Traits\ToIntegerPrimitiveArrayTrait;
use LDL\Validators\IntegerValidator;

final class IntegerCollection extends AbstractTypedCollection implements IntegerCollectionInterface
{
    use FilterUniqueIntegerCollectionInterfaceTrait;
    use FilterUnsignedIntegerCollectionInterfaceTrait;
    use ToIntegerPrimitiveArrayTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->append(new IntegerValidator())
            ->lock();

        parent::__construct($items);
    }

}