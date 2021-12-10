<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Scalar;

use LDL\Validators\ScalarValidator;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Validator\UniqueTypeValidator;
use LDL\Framework\Base\Contracts\Type\ToScalarInterface;
use LDL\Type\Collection\Interfaces\Type\ScalarCollectionInterface;
use LDL\Type\Collection\Traits\Types\Bool\FilterBoolCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Double\FilterDoubleCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\String\FilterStringCollectionInterfaceTrait;
use LDL\Type\Collection\Traits\Types\Integer\FilterIntegerCollectionInterfaceTrait;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;

final class UniqueScalarCollection extends AbstractTypedCollection implements ScalarCollectionInterface
{
    use FilterIntegerCollectionInterfaceTrait;
    use FilterDoubleCollectionInterfaceTrait;
    use FilterBoolCollectionInterfaceTrait;
    use FilterStringCollectionInterfaceTrait;
    use Traits\ScalarTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->appendMany([
                new ScalarValidator(),
                new UniqueTypeValidator('toScalar')
            ])
            ->lock();

        parent::__construct($items);
    }

    /**
     * @param bool $preserveKeys
     * @return array
     */
    public function toPrimitiveArray(bool $preserveKeys): array
    {
        $values =  IterableHelper::map(
            $this,
            /**
             * @param ToScalarInterface $val
             * @return mixed
             */
            static function($val){
                if(!is_object($val)){
                    return $val;
                }

                return $val->toScalar();
            });

        return $preserveKeys ? $values : array_values($values);
    }

}