<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorModeTrait;
use LDL\Type\Exception\TypeMismatchException;

class ObjectValidator implements AppendItemValidatorInterface, ValidatorModeInterface, ValueValidatorInterface
{
    use ValidatorModeTrait;

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(is_object($item)){
            return;
        }

        $msg = sprintf(
            'Validator "%s", only accepts objects as items being part of a collection',
            __CLASS__
        );

        throw new TypeMismatchException($msg);
    }

}