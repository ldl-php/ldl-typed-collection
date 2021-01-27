<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Classes\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorModeTrait;
use LDL\Type\Exception\TypeMismatchException;

class ClassExistenceValidator implements AppendItemValidatorInterface, ValidatorModeInterface, ValueValidatorInterface, KeyValidatorInterface
{
    use ValidatorModeTrait;

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->validateValue($collection, $key, $item);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(class_exists($item)){
            return;
        }

        $msg = sprintf(
            'Value expected for "%s", must be a string representing an existing class, "%s" was given. Perhaps an autoloader is missing? Perhaps the namespace of the class is written incorrectly?',
            __CLASS__,
            $item
        );

        throw new TypeMismatchException($msg);
    }

}