<?php declare(strict_types=1);

/**
 * Namespace Arrays is plural to maintain compatibility between PHP versions that do not
 * support keywords in namespaces.
 */

namespace LDL\Type\Collection\Types\Arrays;

use LDL\Framework\Base\Contracts\Type\ToArrayKeyInterface;
use LDL\Framework\Base\Traits\LockableObjectInterfaceTrait;
use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Traits\Types\Double\FilterDoubleCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Integer\FilterIntegerCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Number\FilterNumberCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\String\FilterStringCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Types\Arrays\Traits\ArrayKeyTrait;
use LDL\Type\Collection\Validator\UniqueTypeValidator;
use LDL\Validators\ArrayKeyValidator;
use LDL\Validators\Chain\AndValidatorChain;
use LDL\Validators\Chain\OrValidatorChain;

final class UniqueArrayKeyCollection extends AbstractTypedCollection implements ToPrimitiveArrayInterface
{
    use LockableObjectInterfaceTrait;
    use AppendValueValidatorChainTrait;

    use FilterIntegerCollectionInterfaceTrait;
    use FilterNumberCollectionInterfaceTrait;
    use FilterDoubleCollectionInterfaceTrait;
    use FilterStringCollectionInterfaceTrait;
    use ArrayKeyTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain(OrValidatorChain::class)
            ->getChainItems()
            ->appendMany([
                new ArrayKeyValidator(),
                new AndValidatorChain([
                    new UniqueTypeValidator(ToArrayKeyInterface::TO_ARRAY_KEY_TYPE_METHOD_NAME),
                ])
            ])
            ->lock();

        parent::__construct($items);
    }

}