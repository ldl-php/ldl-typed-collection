<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Lockable\Validator;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Contracts\LockableObjectInterface;
use LDL\Framework\Base\Exception\LockingException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\RemoveItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Exception\TypeMismatchException;

class LockingValidator implements AppendItemValidatorInterface, RemoveItemValidatorInterface, KeyValidatorInterface, ValueValidatorInterface
{
    public function validateKey(CollectionInterface $collection, $item, $key) : void
    {
        $this->validateValue($collection, $item, $key);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(!$collection instanceof LockableObjectInterface){
            $msg = sprintf(
                'To use "%s", your collection must implement "%s"',
            __CLASS__,
                LockableObjectInterface::class
            );

            throw new TypeMismatchException($msg);
        }

        if($collection->isLocked()){
            $msg = 'Collection is locked, can not add or remove elements';
            throw new LockingException($msg);
        }
    }

    public function jsonSerialize() : array
    {
        return $this->toArray();
    }

    public static function fromArray(array $data = []): ArrayFactoryInterface
    {
        return new self();
    }

    public function toArray(): array
    {
        return [
            'class' => __CLASS__,
            'options' => []
        ];
    }
}
