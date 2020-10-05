<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Lockable\Validator;

use LDL\Framework\Base\Exception\LockingException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Locking\LockableCollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\RemoveItemValidatorInterface;
use LDL\Type\Exception\TypeMismatchException;

class LockingValidator implements AppendItemValidatorInterface, RemoveItemValidatorInterface
{
    public function validate(
        CollectionInterface $collection, $item, $key
    ): void
    {
        if(!$collection instanceof LockableCollectionInterface){
            $msg = sprintf(
                'To use "%s", your collection must implement "%s"',
            __CLASS__,
                LockableCollectionInterface::class
            );

            throw new TypeMismatchException($msg);
        }

        if($collection->isLocked()){
            $msg = 'Collection is locked, can not add or remove elements';
            throw new LockingException($msg);
        }
    }
}
