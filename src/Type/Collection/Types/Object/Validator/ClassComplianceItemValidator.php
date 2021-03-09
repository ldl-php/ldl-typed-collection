<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Types\Object\Validator\Config\ClassComplianceItemValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\InvalidConfigException;
use LDL\Type\Exception\TypeMismatchException;

class ClassComplianceItemValidator implements AppendItemValidatorInterface, ValueValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var ClassComplianceItemValidatorConfig
     */
    private $config;

    public function __construct(string $class, bool $strict=true)
    {
        $this->config = new ClassComplianceItemValidatorConfig($class, $strict);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(!is_object($item)){
            $msg = sprintf(
                'Validator "%s", only accepts objects as items being part of a collection',
                __CLASS__
            );
            throw new TypeMismatchException($msg);
        }

        $class = $this->config->getClass();

        if($item instanceof $class) {
            return;
        }

        $msg = sprintf(
            'Item to be added of class "%s", is not an instanceof class: "%s"',
            get_class($item),
            $class
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
        if(false === $config instanceof ClassComplianceItemValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new InvalidConfigException($msg);
        }

        /**
         * @var ClassComplianceItemValidatorConfig $config
         */
        return new self($config->getClass(), $config->isStrict());
    }

    /**
     * @return ClassComplianceItemValidatorConfig
     */
    public function getConfig(): ClassComplianceItemValidatorConfig
    {
        return $this->config;
    }
}