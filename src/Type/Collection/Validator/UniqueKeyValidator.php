<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Exception\CollectionKeyException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;

class UniqueKeyValidator implements ValidatorInterface
{
    public function validate(CollectionInterface $collection, $item, $key): void
    {
        if($collection->hasKey($key)){
            throw new CollectionKeyException("Item with key \"$key\" already exists in this collection!");
        }
    }
}