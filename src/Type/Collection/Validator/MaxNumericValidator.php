<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorModeTrait;
use LDL\Type\Collection\Validator\Exception\NumericRangeValidatorException;

class MaxNumericValidator implements AppendItemValidatorInterface, ValidatorModeInterface, KeyValidatorInterface, ValueValidatorInterface
{
    use ValidatorModeTrait;

    /**
     * @var number
     */
    private $value;

    /**
     * MaxNumericValueValidator constructor.
     * @param $value
     * @param bool $isStrict
     */
    public function __construct($value, bool $isStrict=true)
    {
        $this->_isStrict = $isStrict;

        if(null !== $value && false === filter_var($value, \FILTER_VALIDATE_INT | \FILTER_VALIDATE_FLOAT)){
            throw new \InvalidArgumentException("Given maximum value must be a number, \"$value\" was given");
        }

        $this->value = $value;
    }

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->validateValue($collection, $key, $item);
    }

    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @throws NumericRangeValidatorException
     */
    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if($item <= $this->value){
            return;
        }

        $msg = "Items in this collection can not be greater than: {$this->value}";
        throw new NumericRangeValidatorException($msg);
    }
}
