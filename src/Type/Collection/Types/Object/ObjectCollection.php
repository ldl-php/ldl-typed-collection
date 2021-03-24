<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object;

use LDL\Framework\Base\Collection\Traits\FilterByClassInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\FilterByInterfaceTrait;
use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Traits\Validator\AppendValidatorChainTrait;
use LDL\Validators\ObjectValidator;

class ObjectCollection extends AbstractCollection implements ObjectCollectionInterface
{
    use AppendValidatorChainTrait;
    use FilterByClassInterfaceTrait;
    use FilterByInterfaceTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValidatorChain()
            ->append(new ObjectValidator());

        parent::__construct($items);
    }
}