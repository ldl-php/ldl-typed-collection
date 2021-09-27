<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\String;

use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Traits\Types\String\FilterUniqueStringCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Validators\StringValidator;

final class StringCollection extends AbstractStringCollection implements ToPrimitiveArrayInterface
{
    use AppendValueValidatorChainTrait;
    use FilterUniqueStringCollectionInterfaceTrait;

    /**
     * @var string
     */
    private $imploded;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->append(new StringValidator())
            ->lock();

        parent::__construct($items);
    }
}