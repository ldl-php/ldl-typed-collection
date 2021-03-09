<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Double\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Types\Double\Validator\Config\DoubleValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\InvalidConfigException;
use LDL\Type\Exception\TypeMismatchException;

class DoubleValidator implements AppendItemValidatorInterface, ValueValidatorInterface, KeyValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var DoubleValidatorConfig
     */
    private $config;

    public function __construct(bool $strict=true)
    {
        $this->config = new DoubleValidatorConfig($strict);
    }

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->validateValue($collection, $key, $item);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(is_float($item)){
            return;
        }

        $msg = sprintf(
          'Value expected for "%s", must be of type double, "%s" given',
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
        if(false === $config instanceof DoubleValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new InvalidConfigException($msg);
        }

        /**
         * @var DoubleValidatorConfig $config
         */
        return new self($config->isStrict());
    }

    /**
     * @return DoubleValidatorConfig
     */
    public function getConfig(): DoubleValidatorConfig
    {
        return $this->config;
    }
}