<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Scalar\Traits;

use LDL\Framework\Base\Contracts\Type\ToScalarInterface;
use LDL\Framework\Helper\ClassHelper;
use LDL\Framework\Helper\IterableHelper;

trait ScalarTrait
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
             * @param ToScalarInterface $val
             * @return mixed
             */
            static function($val){
                if(!is_object($val)){
                    return $val;
                }

                return $val->toScalar();
            });

        return $preserveKeys ? $result : array_values($result);
    }

    public function implode(string $separator, bool $considerToStringObjects = true): string
    {
        return implode(IterableHelper::map($this, static function($item) use ($considerToStringObjects){
            return is_object($item) && !ClassHelper::hasMethod(get_class($item), '__toString', false) ? $item->toScalar() : $item;
        }), $separator);
    }

}