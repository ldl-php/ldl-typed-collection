<?php

namespace LDL\Type\Collection\Types\String;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Exception\TypeMismatchException;

class StringCollection extends AbstractCollection
{

    public function validateItem($item): void
    {
        if(is_string($item)){
            return;
        }

        $msg = sprintf(
            'string type is required for %s, "%s" was given',
            __CLASS__,
            gettype($item)
        );

        throw new TypeMismatchException($msg);
    }

}