<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Types\Object\Validator\Config\ObjectValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\InvalidConfigException;
use LDL\Type\Exception\TypeMismatchException;

class ObjectValidator implements AppendItemValidatorInterface, ValueValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var ObjectValidatorConfig
     */
    private $config;

    public function __construct(bool $strict=true)
    {
        $this->config = new ObjectValidatorConfig($strict);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(is_object($item)){
            return;
        }

        $msg = sprintf(
            'Validator "%s", only accepts objects as items being part of a collection',
            __CLASS__
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
        if(false === $config instanceof ObjectValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new InvalidConfigException($msg);
        }

        /**
         * @var ObjectValidatorConfig $config
         */
        return new self($config->isStrict());
    }

    /**
     * @return ObjectValidatorConfig
     */
    public function getConfig(): ObjectValidatorConfig
    {
        return $this->config;
    }
}