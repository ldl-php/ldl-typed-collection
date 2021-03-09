<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Exception\CollectionKeyException;
use LDL\Type\Collection\Exception\CollectionValueException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Validator\Config\UniqueValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;

class UniqueValidator implements AppendItemValidatorInterface, KeyValidatorInterface, ValueValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var UniqueValidatorConfig
     */
    private $config;

    public function __construct(bool $strict = true)
    {
        $this->config = new UniqueValidatorConfig($strict);
    }

    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @throws CollectionKeyException
     */
    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        if(false === $collection->hasKey($key)) {
            return;
        }

        throw new CollectionKeyException("Item with key \"$key\" already exists in this collection!");
    }

    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @throws CollectionValueException
     */
    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(false === $collection->hasValue($item)){
            return;
        }

        throw new CollectionValueException(
            sprintf(
                'Item with value %s already exists in this collection!',
                var_export($item, true)
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
        if(false === $config instanceof UniqueValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new Exception\InvalidConfigException($msg);
        }

        /**
         * @var UniqueValidatorConfig $config
         */
        return new self($config->isStrict());
    }

    /**
     * @return UniqueValidatorConfig
     */
    public function getConfig(): UniqueValidatorConfig
    {
        return $this->config;
    }
}
