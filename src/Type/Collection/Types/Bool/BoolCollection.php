<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Bool;

use LDL\Framework\Base\Contracts\Type\ToBooleanInterface;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Validators\BoolValidator;

final class BoolCollection extends AbstractTypedCollection implements HasAppendValueValidatorChainInterface, ToPrimitiveArrayInterface
{
    use AppendValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->append(new BoolValidator())
            ->lock();

        parent::__construct($items);
    }

    /**
     * @param bool $preserveKeys
     * @return array
     */
    public function toPrimitiveArray(bool $preserveKeys): array
    {
        $result =  IterableHelper::map(
            $this,
            /**
             * @param ToBooleanInterface $val
             * @return mixed
             */
            static function($val){
                if(is_bool($val)){
                    return $val;
                }

                return $val->toBoolean();
            });

        return $preserveKeys ? $result : array_values($result);
    }
}