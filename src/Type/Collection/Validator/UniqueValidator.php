<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Exception\CollectionValueException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorModeTrait;

class UniqueValidator implements AppendItemValidatorInterface, ValidatorModeInterface, KeyValidatorInterface, ValueValidatorInterface
{
    use ValidatorModeTrait;

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->validateValue($collection, $key, $item);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(!$collection->hasValue($item)){
            return;
        }

        throw new CollectionValueException(
            sprintf(
                'Item with value %s already exists in this collection!',
                var_export($item, true)
            )
        );
    }
}