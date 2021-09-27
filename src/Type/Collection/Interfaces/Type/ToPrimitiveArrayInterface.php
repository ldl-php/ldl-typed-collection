<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Type;

interface ToPrimitiveArrayInterface
{

    /**
     * Returns an array of primitive types, for collections containing a mixture of objects and primitive values
     *
     * @param bool $preserveKeys
     * @return array
     */
    public function toPrimitiveArray(bool $preserveKeys) : array;

}