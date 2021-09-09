<?php declare(strict_types=1);

namespace LDL\Type\Collection;

use LDL\Framework\Base\Collection\Traits\AppendInPositionInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\AppendableInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\AppendManyTrait;
use LDL\Framework\Base\Collection\Traits\BeforeRemoveInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\BeforeResolveKeyInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\CollectionInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\KeyFilterInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\LockAppendInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\LockRemoveInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\LockReplaceInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\RemovableInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\ReplaceByKeyInterfaceTrait;
use LDL\Framework\Base\Collection\Traits\ReplaceEqualValueInterfaceTrait;

use LDL\Framework\Base\Traits\LockableObjectInterfaceTrait;

abstract class AbstractCollection implements TypedCollectionInterface
{
    use CollectionInterfaceTrait;

    use LockableObjectInterfaceTrait;

    use BeforeResolveKeyInterfaceTrait;

    use AppendInPositionInterfaceTrait;
    use AppendableInterfaceTrait;
    use AppendManyTrait;
    use LockAppendInterfaceTrait;

    use BeforeRemoveInterfaceTrait;
    use RemovableInterfaceTrait;
    use LockRemoveInterfaceTrait;

    use ReplaceByKeyInterfaceTrait;
    use ReplaceEqualValueInterfaceTrait;
    use LockReplaceInterfaceTrait;


    use KeyFilterInterfaceTrait;

    public function __construct(iterable $items=null)
    {
        if(null !== $items){
            $this->appendMany($items);
        }
    }
}
