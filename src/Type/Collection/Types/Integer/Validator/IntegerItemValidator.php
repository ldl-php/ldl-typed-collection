<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Integer\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorModeTrait;
use LDL\Type\Exception\TypeMismatchException;

class IntegerItemValidator implements AppendItemValidatorInterface, ValidatorModeInterface
{
    use ValidatorModeTrait;

    public function validate(CollectionInterface $collection, $item, $key): void
    {
        if(is_int($item)){
            return;
        }

        $msg = sprintf(
          'Value expected for "%s", must be of type integer, "%s" given',
            __CLASS__,
            gettype($item)
        );

        throw new TypeMismatchException($msg);
    }

}