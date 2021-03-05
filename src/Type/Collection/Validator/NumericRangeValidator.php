<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Exception\ArrayFactoryException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;

class NumericRangeValidator implements AppendItemValidatorInterface, ValueValidatorInterface, KeyValidatorInterface
{
    /**
     * @var MinNumericValidator
     */
    private $minValidator;

    /**
     * @var MaxNumericValidator
     */
    private $maxValidator;

    /**
     * NumericRangeValidator constructor.
     * @param $min
     * @param $max
     *
     */
    public function __construct($min, $max)
    {
        $this->minValidator = new MinNumericValidator($min);
        $this->maxValidator = new MaxNumericValidator($max);
    }

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->minValidator->validateKey($collection, $item, $key);
        $this->maxValidator->validateKey($collection, $item, $key);
    }

    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @throws Exception\NumericRangeValidatorException
     */
    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        $this->minValidator->validateValue($collection, $item, $key);
        $this->maxValidator->validateValue($collection, $item, $key);
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
     * @throws ArrayFactoryException
     */
    public static function fromArray(array $data = []): ArrayFactoryInterface
    {
        if(false === array_key_exists('min', $data)){
            $msg = sprintf("Missing property 'min' in %s", __CLASS__);
            throw new ArrayFactoryException($msg);
        }

        if(false === array_key_exists('max', $data)){
            $msg = sprintf("Missing property 'max' in %s", __CLASS__);
            throw new ArrayFactoryException($msg);
        }

        return new self($data['min'], $data['max']);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'class' => __CLASS__,
            'options' => [
                'min' => $this->minValidator->toArray()['options']['value'],
                'max' => $this->maxValidator->toArray()['options']['value']
            ]
        ];
    }
}
