<?php

namespace LDL\Type\Collection\Types\Integer;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Exception\TypeMismatchException;

class IntegerCollection extends AbstractCollection
{

    public function validateItem($item): void
    {
        if(is_int($item)){
            return;
        }

        $msg = sprintf(
            'int type is required for %s, "%s" was given',
            __CLASS__,
            gettype($item)
        );

        throw new TypeMismatchException($msg);
    }

}