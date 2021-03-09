<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Types\Object\Validator\Config\StrictClassComplianceItemValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\InvalidConfigException;
use LDL\Type\Exception\TypeMismatchException;

class StrictClassComplianceItemValidator implements AppendItemValidatorInterface, ValueValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var StrictClassComplianceItemValidatorConfig
     */
    private $config;

    public function __construct(string $class, bool $strict=true)
    {
        $this->config = new StrictClassComplianceItemValidatorConfig($class, $strict);
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

        $itemClass = get_class($item);

        if($itemClass === $this->config->getClass()) {
            return;
        }

        $msg = sprintf(
            'Item to be added of class "%s", must be *exactly* an object of class: "%s"',
            get_class($item),
            $this->config->getClass()
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
        if(false === $config instanceof StrictClassComplianceItemValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new InvalidConfigException($msg);
        }

        /**
         * @var StrictClassComplianceItemValidatorConfig $config
         */
        return new self($config->getClass(), $config->isStrict());
    }

    /**
     * @return StrictClassComplianceItemValidatorConfig
     */
    public function getConfig(): StrictClassComplianceItemValidatorConfig
    {
        return $this->config;
    }
}