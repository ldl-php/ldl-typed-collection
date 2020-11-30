<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Validator;

trait NumericRangeValidatorTrait
{
    /**
     * @var bool
     */
    private $_isStrict;

    /**
     * @var number
     */
    private $_min;

    /**
     * @var number
     */
    private $_max;

    public function __construct(bool $strict = true, $min = null, $max = null)
    {
        $this->_isStrict = $strict;

        if(null !== $min && false === filter_var($min, \FILTER_VALIDATE_INT | \FILTER_VALIDATE_FLOAT)){
            throw new \InvalidArgumentException("Given minimum value must be a number, \"$min\" was given");
        }

        $this->_min = $min;

        if(null !== $max && false === filter_var($max, \FILTER_VALIDATE_INT | \FILTER_VALIDATE_FLOAT)){
            throw new \InvalidArgumentException("Given minimum value must be a number, \"$min\" was given");
        }

        $this->_max = $max;
    }

    public function isStrict() : bool
    {
        return $this->_isStrict;
    }

    private function _validateRange($value) : void
    {
        if(null === $this->_min && null === $this->_max){
            return;
        }

        if(null !== $this->_min && $value < $this->_min){
            $msg = "Minimum value must be: \"{$this->_min}\", \"$value\" was given";
            throw new \InvalidArgumentException($msg);
        }

        if(null !== $this->_max && $value > $this->_max){
            $msg = "Maximum value must be: \"{$this->_max}\", \"$value\" was given";
            throw new \InvalidArgumentException($msg);
        }
    }
}