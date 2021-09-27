<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Double\Traits;

use LDL\Framework\Base\Contracts\Type\ToDoubleInterface;
use LDL\Framework\Helper\IterableHelper;

trait ToDoublePrimitiveArrayTrait
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
             * @param ToDoubleInterface $val
             * @return mixed
             */
            static function($val){
                if(!is_object($val)){
                    return $val;
                }

                return $val->toDouble();
            });

        return $preserveKeys ? $result : array_values($result);
    }
}