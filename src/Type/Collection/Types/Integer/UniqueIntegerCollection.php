<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Integer;

use LDL\Framework\Base\Contracts\Type\ToIntegerInterface;
use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Types\Integer\FilterUnsignedIntegerCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Types\Integer\Traits\ToIntegerPrimitiveArrayTrait;
use LDL\Type\Collection\Validator\UniqueTypeValidator;
use LDL\Validators\IntegerValidator;

final class UniqueIntegerCollection extends AbstractTypedCollection implements  ToPrimitiveArrayInterface
{
    use FilterUnsignedIntegerCollectionInterfaceTrait;
    use ToIntegerPrimitiveArrayTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->appendMany([
                new IntegerValidator(),
                new UniqueTypeValidator(ToIntegerInterface::TO_INTEGER_TYPE_METHOD_NAME)
            ])
            ->lock();

        parent::__construct($items);
    }

}