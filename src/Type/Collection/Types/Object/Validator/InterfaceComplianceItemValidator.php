<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Types\Object\Validator\Config\InterfaceComplianceItemValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\InvalidConfigException;
use LDL\Type\Exception\TypeMismatchException;

class InterfaceComplianceItemValidator implements AppendItemValidatorInterface, ValueValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var InterfaceComplianceItemValidatorConfig
     */
    private $config;

    public function __construct(string $interface, bool $strict=true)
    {
        $this->config = new InterfaceComplianceItemValidatorConfig($interface, $strict);
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

        $interface = $this->config->getInterface();

        if($item instanceof $interface) {
            return;
        }

        $msg = sprintf(
            'Item to be added of class "%s", does not complies to interface: "%s"',
            get_class($item),
            $interface
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
        if(false === $config instanceof InterfaceComplianceItemValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new InvalidConfigException($msg);
        }

        /**
         * @var InterfaceComplianceItemValidatorConfig $config
         */
        return new self($config->getInterface(), $config->isStrict());
    }

    /**
     * @return InterfaceComplianceItemValidatorConfig
     */
    public function getConfig(): InterfaceComplianceItemValidatorConfig
    {
        return $this->config;
    }
}