<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Validator\Config\MaxNumericValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\NumericRangeValidatorException;

class MaxNumericValidator implements AppendItemValidatorInterface, KeyValidatorInterface, ValueValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var MaxNumericValidatorConfig
     */
    private $config;

    public function __construct($value, bool $strict=true)
    {
        $this->config = new MaxNumericValidatorConfig($value, $strict);
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
        if($item <= $this->config->getValue()){
            return;
        }

        $msg = "Items in this collection can not be greater than: {$this->config->getValue()}";
        throw new NumericRangeValidatorException($msg);
    }

    /**
     * @param ValidatorConfigInterface $config
     * @return ValidatorInterface
     * @throws Exception\InvalidConfigException
     */
    public static function fromConfig(ValidatorConfigInterface $config): ValidatorInterface
    {
        if(false === $config instanceof MaxNumericValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new Exception\InvalidConfigException($msg);
        }

        /**
         * @var MaxNumericValidatorConfig $config
         */
        return new self($config->getValue(), $config->isStrict());
    }

    /**
     * @return MaxNumericValidatorConfig
     */
    public function getConfig(): MaxNumericValidatorConfig
    {
        return $this->config;
    }
}
