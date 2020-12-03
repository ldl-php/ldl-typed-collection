<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Exception\CollectionKeyException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorModeTrait;

class UniqueKeyValidator implements AppendItemValidatorInterface, ValidatorModeInterface, KeyValidatorInterface
{
    use ValidatorModeTrait;

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        if(false === $collection->hasKey($item)) {
            return;
        }

        throw new CollectionKeyException("Item with key \"$item\" already exists in this collection!");
    }
}