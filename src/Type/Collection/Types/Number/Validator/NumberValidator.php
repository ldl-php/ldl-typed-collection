<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Number\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorModeTrait;
use LDL\Type\Exception\TypeMismatchException;

class NumberValidator implements ValidatorInterface, ValidatorModeInterface
{

    use ValidatorModeTrait;

    public function validate(CollectionInterface $collection, $item, $key): void
    {
        if(is_numeric($item)){
            return;
        }

        $msg = sprintf(
          'Value expected for "%s", must comply to is_numeric function, "%s" given',
            __CLASS__,
            gettype($item)
        );

        throw new TypeMismatchException($msg);
    }

}