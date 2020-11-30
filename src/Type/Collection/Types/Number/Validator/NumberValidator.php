<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Number\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Traits\Validator\NumericRangeValidatorTrait;
use LDL\Type\Exception\TypeMismatchException;

class NumberValidator implements AppendItemValidatorInterface, ValidatorModeInterface
{

    use NumericRangeValidatorTrait;

    public function validate(CollectionInterface $collection, $item, $key): void
    {
        if(is_numeric($item)){
            $this->_validateRange($item);
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