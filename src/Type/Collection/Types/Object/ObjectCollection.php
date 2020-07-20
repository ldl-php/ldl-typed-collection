<?php

namespace LDL\Type\Collection\Types\Object;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Exception\TypeMismatchException;

class ObjectCollection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     *
     * @throws TypeMismatchException
     */
    public function validateItem($item) : void
    {
        $type = gettype($item);

        if($type === 'object') {
            return;
        }

        $msg = sprintf(
            'Argument must be an object, "%s" was given',
            $type
        );

        throw new TypeMismatchException($msg);
    }
}