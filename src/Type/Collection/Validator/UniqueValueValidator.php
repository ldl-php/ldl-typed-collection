<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Exception\CollectionValueException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;

class UniqueValueValidator implements ValidatorInterface
{
    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @throws CollectionValueException
     */
    public function validate(CollectionInterface $collection, $item, $key): void
    {
        if(!$collection->hasValue($item)) {
            return;
        }

        $msg = sprintf(
            'Provided value: %s already exists in this collection',
            is_object($item) ? get_class($item) : var_export($item, true)
        );

        throw new CollectionValueException($msg);
    }
}