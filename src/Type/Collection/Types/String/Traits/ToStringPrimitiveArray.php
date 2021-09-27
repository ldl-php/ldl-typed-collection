<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\String\Traits;

use LDL\Framework\Base\Contracts\Type\ToStringInterface;
use LDL\Framework\Helper\IterableHelper;

trait ToStringPrimitiveArray{
    /**
     * @param bool $preserveKeys
     * @return array
     */
    public function toPrimitiveArray(bool $preserveKeys): array
    {
        $result = IterableHelper::map(
            $this,
            /**
             * @param ToStringInterface $val
             * @return mixed
             */
            static function($val){
                if(!is_object($val)){
                    return $val;
                }

                return $val->toString();
            });

        return $preserveKeys ? $result : array_values($result);
    }
}