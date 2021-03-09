<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\String\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Types\String\Validator\Config\StringValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\InvalidConfigException;
use LDL\Type\Exception\TypeMismatchException;

class StringValidator implements AppendItemValidatorInterface, KeyValidatorInterface, ValueValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var StringValidatorConfig
     */
    private $config;

    public function __construct(bool $strict=true)
    {
        $this->config = new StringValidatorConfig($strict);
    }

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->validateValue($collection, $key, $item);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(is_string($item)){
            return;
        }

        $msg = sprintf(
          'Value expected for "%s", must be of type string, "%s" was given',
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
        if(false === $config instanceof StringValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new InvalidConfigException($msg);
        }

        /**
         * @var StringValidatorConfig $config
         */
        return new self($config->isStrict());
    }

    /**
     * @return StringValidatorConfig
     */
    public function getConfig(): StringValidatorConfig
    {
        return $this->config;
    }
}