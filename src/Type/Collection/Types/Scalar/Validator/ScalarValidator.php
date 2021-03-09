<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Scalar\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Types\Scalar\Validator\Config\ScalarValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\InvalidConfigException;
use LDL\Type\Exception\TypeMismatchException;

class ScalarValidator implements AppendItemValidatorInterface, ValueValidatorInterface, KeyValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var ScalarValidatorConfig
     */
    private $config;

    public function __construct(bool $acceptToStringObjects=true, bool $strict = false)
    {
        $this->config = new ScalarValidatorConfig($acceptToStringObjects, $strict);
    }

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->validateValue($collection, $key, $item);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(is_scalar($item)){
            return;
        }

        /**
         * Object with __toString method
         */
        if(
            $this->config->isAcceptToStringObjects() &&
            is_object($item) &&
            in_array('__tostring', array_map('strtolower', get_class_methods($item)), true)
        ){
            return;
        }

        $msg = sprintf(
            'Value expected for "%s", must be scalar, "%s" was given',
            __CLASS__,
            gettype($item)
        );

        throw new TypeMismatchException($msg);
    }

    /**
     * @param ValidatorConfigInterface $config
     * @return ValidatorInterface
     * @throws InvalidConfigException
     */
    public static function fromConfig(ValidatorConfigInterface $config): ValidatorInterface
    {
        if(false === $config instanceof ScalarValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new InvalidConfigException($msg);
        }

        /**
         * @var ScalarValidatorConfig $config
         */
        return new self($config->isAcceptToStringObjects(), $config->isStrict());
    }

    /**
     * @return ScalarValidatorConfig
     */
    public function getConfig(): ScalarValidatorConfig
    {
        return $this->config;
    }
}