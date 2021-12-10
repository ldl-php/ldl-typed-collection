<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Scalar;

use LDL\Validators\ScalarValidator;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Framework\Base\Contracts\Type\ToStringInterface;
use LDL\Type\Collection\Interfaces\Type\ScalarCollectionInterface;
use LDL\Type\Collection\Traits\Types\Bool\FilterBoolCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Double\FilterDoubleCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\String\FilterStringCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Integer\FilterIntegerCollectionInterfaceTrait;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Types\Scalar\FilterUniqueScalarCollectionInterfaceTrait;

final class ScalarCollection extends AbstractTypedCollection implements ScalarCollectionInterface
{
    use FilterIntegerCollectionInterfaceTrait;
    use FilterDoubleCollectionInterfaceTrait;
    use FilterBoolCollectionInterfaceTrait;
    use FilterStringCollectionInterfaceTrait;
    use FilterUniqueScalarCollectionInterfaceTrait;
    use Traits\ScalarTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->append(new ScalarValidator())
            ->lock();

        parent::__construct($items);
    }

}