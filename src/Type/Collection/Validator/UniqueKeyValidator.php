<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Exception\CollectionKeyException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorModeTrait;

class UniqueKeyValidator implements AppendItemValidatorInterface, ValidatorModeInterface
{
    use ValidatorModeTrait;

    public function validate(CollectionInterface $collection, $item, $key): void
    {
        if($collection->hasKey($item)){
            throw new CollectionKeyException("Item with key \"$item\" already exists in this collection!");
        }
    }
}