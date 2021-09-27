<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Numeric\Traits;

use LDL\Framework\Base\Contracts\Type\ToNumericInterface;
use LDL\Framework\Helper\IterableHelper;

trait ToNumericPrimitiveArrayTrait
{
    /**
     * @param bool $preserveKeys
     * @return array
     */
    public function toPrimitiveArray(bool $preserveKeys): array
    {
        $result = IterableHelper::map(
            $this,
            /**
             * @param ToNumericInterface $val
             * @return mixed
             */
            static function($val){
                if(!is_object($val)){
                    return $val;
                }

                return $val->toNumeric();
            });

        return $preserveKeys ? $result : array_values($result);
    }
}