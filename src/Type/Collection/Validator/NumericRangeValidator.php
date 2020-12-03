<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

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
}
