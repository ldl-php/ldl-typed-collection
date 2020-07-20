<?php

namespace LDL\Type\Collection\Types\Double;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Exception\TypeMismatchException;

class DoubleCollection extends AbstractCollection
{

    public function validateItem($item): void
    {
        /**
         * Did you know that internally
         */
        if(is_float($item)){
            return;
        }

        $msg = sprintf(
            'float type is required for %s, "%s" was given',
            __CLASS__,
            gettype($item)
        );

        throw new TypeMismatchException($msg);
    }

}