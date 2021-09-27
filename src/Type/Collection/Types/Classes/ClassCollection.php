<?php declare(strict_types=1);

/**
 * Use this collection when you need to have a series of classes as a string, making sure that
 * the passed class string does indeed exist.
 */

namespace LDL\Type\Collection\Types\Classes;

use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Traits\Types\String\FilterUniqueStringCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Types\String\Traits\ToStringPrimitiveArray;
use LDL\Validators\ClassExistenceValidator;

final class ClassCollection extends AbstractTypedCollection implements ToPrimitiveArrayInterface
{
    use AppendValueValidatorChainTrait;
    use FilterUniqueStringCollectionInterfaceTrait;
    use ToStringPrimitiveArray;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->append(new ClassExistenceValidator());

        parent::__construct($items);
    }
}