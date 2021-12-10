<?php declare(strict_types=1);

/**
 * Namespace "Arrays" is plural to maintain compatibility between PHP versions that do not
 * support keywords in namespaces. An array key collection contains types which are valid for array keys
 * namely integers and strings.
 */

namespace LDL\Type\Collection\Types\Arrays;

use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\ArrayKeyCollectionInterface;
use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Types\Integer\FilterIntegerCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\String\FilterStringCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Number\FilterNumberCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Types\Arrays\Traits\ArrayKeyTrait;
use LDL\Validators\ArrayKeyValidator;
use LDL\Validators\Chain\OrValidatorChain;
use LDL\Validators\IntegerValidator;
use LDL\Validators\StringValidator;

final class ArrayKeyCollection extends AbstractTypedCollection implements ArrayKeyCollectionInterface
{
    use AppendValueValidatorChainTrait;
    use FilterIntegerCollectionInterfaceTrait;
    use FilterNumberCollectionInterfaceTrait;
    use FilterStringCollectionInterfaceTrait;
    use ArrayKeyTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain(OrValidatorChain::class)
            ->getChainItems()
            ->appendMany([
                new ArrayKeyValidator(),
                new OrValidatorChain([
                    new IntegerValidator(),
                    new StringValidator()
                ])
            ])
            ->lock();

        parent::__construct($items);
    }

}