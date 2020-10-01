<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Double\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorModeTrait;
use LDL\Type\Exception\TypeMismatchException;

class DoubleValidator implements ValidatorInterface
{
    use ValidatorModeTrait;

    public function validate(CollectionInterface $collection, $item, $key): void
    {
        if(is_float($item)){
            return;
        }

        $msg = sprintf(
          'Value expected for "%s", must be of type double, "%s" given',
            __CLASS__,
            gettype($item)
        );

        throw new TypeMismatchException($msg);
    }

}