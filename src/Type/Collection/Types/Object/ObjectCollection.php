<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object;

use LDL\Framework\Base\Collection\Traits\FilterByClassInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\FilterByInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\FilterByMethodInterfaceTrait;
use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Traits\Types\Object\FilterObjectCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\String\FilterStringCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Validators\ObjectValidator;

final class ObjectCollection extends AbstractTypedCollection implements ObjectCollectionInterface
{
    use AppendValueValidatorChainTrait;
    use FilterByClassInterfaceTrait;
    use FilterByInterfaceTrait;
    use FilterStringCollectionInterfaceTrait;
    use FilterByMethodInterfaceTrait;
    use FilterObjectCollectionInterfaceTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->append(new ObjectValidator());

        parent::__construct($items);
    }
}