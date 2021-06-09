<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Type\Collection\Exception\CollectionValueException;
use LDL\Validators\Config\BasicValidatorConfig;
use LDL\Validators\Config\ValidatorConfigInterface;
use LDL\Validators\NegatedValidatorInterface;
use LDL\Validators\Traits\ValidatorValidateTrait;
use LDL\Validators\ValidatorInterface;

class UniqueValidator implements ValidatorInterface, NegatedValidatorInterface
{
    use ValidatorValidateTrait;

    /**
     * @var BasicValidatorConfig
     */
    private $config;

    public function __construct(bool $negated=false, bool $dumpable=true)
    {
        $this->config = new BasicValidatorConfig($negated, $dumpable);
    }

    public function assertTrue($value, $key = null, CollectionInterface $collection = null): void
    {
        if(!$collection->hasValue($value)){
            return;
        }

        throw new CollectionValueException(
            sprintf(
                'Item with value %s already exists in this collection!',
                var_export($value, true)
            )
        );
    }

    public function assertFalse($value, $key = null, CollectionInterface $collection = null): void
    {
        if($collection->hasValue($value)){
            return;
        }

        throw new CollectionValueException(
            sprintf(
                'Item with value %s NOT exists in this collection!',
                var_export($value, true)
            )
        );
    }

    /**
     * @param ValidatorConfigInterface $config
     * @return ValidatorInterface
     * @throws Exception\InvalidConfigException
     */
    public static function fromConfig(ValidatorConfigInterface $config): ValidatorInterface
    {
        if(false === $config instanceof BasicValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new Exception\InvalidConfigException($msg);
        }

        /**
         * @var BasicValidatorConfig $config
         */
        return new self($config->isNegated(), $config->isDumpable());
    }

    /**
     * @return BasicValidatorConfig
     */
    public function getConfig(): BasicValidatorConfig
    {
        return $this->config;
    }
}
