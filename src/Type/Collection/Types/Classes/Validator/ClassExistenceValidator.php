<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Classes\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Types\Classes\Validator\Config\ClassExistenceValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\InvalidConfigException;
use LDL\Type\Exception\TypeMismatchException;

class ClassExistenceValidator implements AppendItemValidatorInterface, ValueValidatorInterface, KeyValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var ClassExistenceValidatorConfig
     */
    private $config;

    public function __construct(bool $strict=true)
    {
        $this->config = ClassExistenceValidatorConfig::fromArray([
            'strict' => $strict
        ]);
    }

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->validateValue($collection, $key, $item);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(class_exists($item)){
            return;
        }

        $msg = sprintf(
            'Value expected for "%s", must be a string representing an existing class, "%s" was given. Perhaps an autoloader is missing? Perhaps the namespace of the class is written incorrectly?',
            __CLASS__,
            $item
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
        if(false === $config instanceof ClassExistenceValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new InvalidConfigException($msg);
        }

        /**
         * @var ClassExistenceValidatorConfig $config
         */
        return new self($config->isStrict());
    }

    /**
     * @return ClassExistenceValidatorConfig
     */
    public function getConfig(): ClassExistenceValidatorConfig
    {
        return $this->config;
    }
}