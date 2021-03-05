<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Type\Collection\Exception\CollectionKeyException;
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

    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @throws CollectionKeyException
     */
    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        if(false === $collection->hasKey($key)) {
            return;
        }

        throw new CollectionKeyException("Item with key \"$key\" already exists in this collection!");
    }

    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @throws CollectionValueException
     */
    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(false === $collection->hasValue($item)){
            return;
        }

        throw new CollectionValueException(
            sprintf(
                'Item with value %s already exists in this collection!',
                var_export($item, true)
            )
        );
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return $this->toArray();
    }

    /**
     * @param array $data
     * @return ArrayFactoryInterface
     */
    public static function fromArray(array $data = []): ArrayFactoryInterface
    {
        return new self(array_key_exists('strict', $data) ? (bool)$data['strict'] : true);
    }

    /**
     * @return array
     */
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
