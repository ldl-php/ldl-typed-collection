<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Integer\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorModeTrait;
use LDL\Type\Exception\TypeMismatchException;

class IntegerValidator implements AppendItemValidatorInterface, ValidatorModeInterface, ValueValidatorInterface, KeyValidatorInterface
{
    use ValidatorModeTrait;

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->validateValue($collection, $key, $item);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(is_int($item)){
            return;
        }

        $msg = sprintf(
          'Value expected for "%s", must be of type integer, "%s" (%s) given',
            __CLASS__,
            gettype($item),
            var_export($item, true)
        );

        throw new TypeMismatchException($msg);
    }

}