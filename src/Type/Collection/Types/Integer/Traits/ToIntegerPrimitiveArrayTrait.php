<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Integer\Traits;

use LDL\Framework\Base\Contracts\Type\ToIntegerInterface;
use LDL\Framework\Helper\IterableHelper;

trait ToIntegerPrimitiveArrayTrait
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
             * @param ToIntegerInterface $val
             * @return mixed
             */
            static function($val){
                if(!is_object($val)){
                    return $val;
                }

                return $val->toInteger();
            });

        return $preserveKeys ? $result : array_values($result);
    }
}