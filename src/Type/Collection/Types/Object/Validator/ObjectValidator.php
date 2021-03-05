<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object\Validator;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorModeTrait;
use LDL\Type\Exception\TypeMismatchException;

class ObjectValidator implements AppendItemValidatorInterface, ValidatorModeInterface, ValueValidatorInterface
{
    use ValidatorModeTrait;

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(is_object($item)){
            return;
        }

        $msg = sprintf(
            'Validator "%s", only accepts objects as items being part of a collection',
            __CLASS__
        );

        throw new TypeMismatchException($msg);
    }

    public function jsonSerialize() : array
    {
        return $this->toArray();
    }

    public static function fromArray(array $data = []): ArrayFactoryInterface
    {
        return new self(array_key_exists('strict', $data) ? (bool)$data['strict'] : true);
    }

    public function toArray(): array
    {
        return [
            'class' => __CLASS__,
            'options' => [
                'strict' => $this->_isStrict
            ]
        ];
    }
}