<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Integer\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Types\Integer\Validator\Config\IntegerValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\InvalidConfigException;
use LDL\Type\Exception\TypeMismatchException;

class IntegerValidator implements AppendItemValidatorInterface, ValueValidatorInterface, KeyValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var IntegerValidatorConfig
     */
    private $config;

    public function __construct(bool $strict=true)
    {
        $this->config = new IntegerValidatorConfig($strict);
    }

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->validateValue($collection, $key, $item);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(is_int($item)){
            return;
        }

        $msg = sprintf(
          'Value expected for "%s", must be of type integer, "%s" (%s) given',
            __CLASS__,
            gettype($item),
            var_export($item, true)
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
        if(false === $config instanceof IntegerValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new InvalidConfigException($msg);
        }

        /**
         * @var IntegerValidatorConfig $config
         */
        return new self($config->isStrict());
    }

    /**
     * @return IntegerValidatorConfig
     */
    public function getConfig(): IntegerValidatorConfig
    {
        return $this->config;
    }
}