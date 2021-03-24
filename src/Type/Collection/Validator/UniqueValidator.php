<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Type\Collection\Exception\CollectionValueException;
use LDL\Type\Collection\Validator\Config\UniqueValidatorConfig;
use LDL\Validators\Config\ValidatorConfigInterface;
use LDL\Validators\HasValidatorConfigInterface;
use LDL\Validators\ValidatorInterface;

class UniqueValidator implements ValidatorInterface, HasValidatorConfigInterface
{
    /**
     * @var UniqueValidatorConfig
     */
    private $config;

    public function __construct(bool $strict = true)
    {
        $this->config = new UniqueValidatorConfig($strict);
    }

    /**
     * @param mixed $item
     * @param null $key
     * @param CollectionInterface|null $collection
     * @throws CollectionValueException
     */
    public function validate($item, $key = null, CollectionInterface $collection = null): void
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
