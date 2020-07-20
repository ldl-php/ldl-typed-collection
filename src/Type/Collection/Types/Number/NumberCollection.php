<?php

namespace LDL\Type\Collection\Types\String;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Exception\TypeMismatchException;

class NumberCollection extends AbstractCollection
{

    public function validateItem($item): void
    {
        if(is_int($item) || is_float($item)){
            return;
        }

        $msg = sprintf(
            'float or int type is required for %s, "%s" was given',
            __CLASS__,
            gettype($item)
        );

        throw new TypeMismatchException($msg);
    }

}