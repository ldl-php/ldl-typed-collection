<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Integer;

use LDL\Validators\IntegerValidator;
use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\IntegerCollectionInterface;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Types\Integer\Traits\ToIntegerPrimitiveArrayTrait;
use LDL\Type\Collection\Types\Integer\Traits\IntegerCollectionInterfaceTrait;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Types\Integer\FilterUniqueIntegerCollectionInterfaceTrait;

final class UnsignedIntegerCollection extends AbstractTypedCollection implements IntegerCollectionInterface
{
    use IntegerCollectionInterfaceTrait;
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