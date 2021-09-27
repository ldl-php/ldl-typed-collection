<?php declare(strict_types=1);

namespace LDL\Type\Collection\Helper;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Framework\Helper\IterableHelper;

final class TypeCollectionHelper
{
    public static function toArray(iterable $items) : array
    {
        $instanceOfCollectionInterface = $items instanceof CollectionInterface;
        return IterableHelper::map($items, static function($val, $key, $items) use($instanceOfCollectionInterface){
            return $instanceOfCollectionInterface ? $items->get($key) : $val;
        });
    }
}
