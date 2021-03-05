<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Exception\ArrayFactoryException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorModeTrait;
use LDL\Type\Collection\Validator\Exception\NumericRangeValidatorException;

class MinNumericValidator implements AppendItemValidatorInterface, ValidatorModeInterface, KeyValidatorInterface, ValueValidatorInterface
{
    use ValidatorModeTrait;

    /**
     * @var number
     */
    private $value;

    /**
     * MinNumericValueValidator constructor.
     * @param $value
     * @param bool $isStrict
     */
    public function __construct($value, bool $isStrict=true)
    {
        $this->_isStrict = $isStrict;

        if(null !== $value && false === filter_var($value, \FILTER_VALIDATE_INT | \FILTER_VALIDATE_FLOAT)){
            throw new \InvalidArgumentException("Given minimum value must be a number, \"$value\" was given");
        }

        $this->value = $value;
    }

    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @throws NumericRangeValidatorException
     */
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
        if($item >= $this->value){
            return;
        }

        $msg = "Items in this collection can not be less than: {$this->value}";
        throw new NumericRangeValidatorException($msg);
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
        if(false === array_key_exists('value', $data)){
            $msg = sprintf("Missing property 'value' in %s", __CLASS__);
            throw new ArrayFactoryException($msg);
        }

        try{
            return new self($data['value'], array_key_exists('strict', $data) ? (bool)$data['strict'] : true);
        }catch(\Exception $e){
            throw new ArrayFactoryException($e->getMessage());
        }

    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'class' => __CLASS__,
            'options' => [
                'value' => $this->value,
                'strict' => $this->_isStrict
            ]
        ];
    }
}
