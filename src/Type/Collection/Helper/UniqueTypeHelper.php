<?php declare(strict_types=1);

namespace LDL\Type\Collection\Helper;

use LDL\Framework\Helper\ArrayHelper\ArrayHelper;
use LDL\Framework\Helper\ClassHelper;
use LDL\Type\Collection\TypedCollectionInterface;

final class UniqueTypeHelper
{
    public static function hasValue($value, string $method, TypedCollectionInterface $collection) : bool
    {
        $values = [];

        if(is_object($value) && !ClassHelper::hasMethod(get_class($value), $method)){
            throw new \InvalidArgumentException(sprintf(
                'Object of class %s does not has a method named %s',
                get_class($value),
                $method
            ));
        }

        $value = is_object($value) ? $value->$method() : $value;

        foreach($collection as $item){
            if(is_object($value) && !ClassHelper::hasMethod(get_class($value), $method)){
                throw new \InvalidArgumentException(sprintf(
                    'Object of class %s does not has a method named %s',
                    get_class($value),
                    $method
                ));
            }

            $values[] = is_object($item) ? $item->$method() : $item;
        }

        return (bool) ArrayHelper::hasValue($values,$value);
    }

    public static function unique(
        iterable $collection,
        string $interface,
        string $method,
        bool $preferObjects=true
    ) : array
    {

        $atomicValues = [];
        $return = [];

        foreach($collection as $key => $item){
            $value = $item;
            $isObject = is_object($item);

            if(
                $isObject &&
                ClassHelper::hasInterface(get_class($item), $interface)
            ){
                $value = $item->$method();
            }

            if(in_array($value, $atomicValues,true)){
                if($isObject && $preferObjects) {
                    ArrayHelper::replaceByCallback($return, $item, static function($val) use($value){
                        return $val === $value;
                    });
                }
                continue;
            }

            $atomicValues[] = $value;
            $return[] = $isObject && $preferObjects ? $item : $value;
        }

        return $return;

    }

}