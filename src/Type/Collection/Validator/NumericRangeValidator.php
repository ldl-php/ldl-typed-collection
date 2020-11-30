<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;

class NumericRangeValidator implements AppendItemValidatorInterface
{
    /**
     * @var MinNumericValueValidator
     */
    private $minValidator;

    /**
     * @var MaxNumericValueValidator
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
        $this->minValidator = new MinNumericValueValidator($min);
        $this->maxValidator = new MaxNumericValueValidator($max);
    }

    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @throws Exception\NumericRangeValidatorException
     */
    public function validate(CollectionInterface $collection, $item, $key): void
    {
        $this->minValidator->validate($collection, $item, $key);
        $this->maxValidator->validate($collection, $item, $key);
    }
}
