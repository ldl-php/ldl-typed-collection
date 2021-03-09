<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\RemoveItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Validator\Config\RegexValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;

class RegexValidator implements AppendItemValidatorInterface, RemoveItemValidatorInterface, KeyValidatorInterface, ValueValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var RegexValidatorConfig
     */
    private $config;

    public function __construct(string $regex, bool $strict=false)
    {
        $this->config = new RegexValidatorConfig($regex, $strict);
    }

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->validateValue($collection, $key, $item);
    }

    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @throws Exception\RegexValidatorException
     *
     */
    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(preg_match($this->config->getRegex(), (string) $item)) {
            return;
        }

        $msg = "Given value: \"$item\" does not matches regex: \"{$this->config->getRegex()}\"";
        throw new Exception\RegexValidatorException($msg);
    }

    /**
     * @param ValidatorConfigInterface $config
     * @return ValidatorInterface
     * @throws Exception\InvalidConfigException
     */
    public static function fromConfig(ValidatorConfigInterface $config): ValidatorInterface
    {
        if(false === $config instanceof RegexValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new Exception\InvalidConfigException($msg);
        }

        /**
         * @var RegexValidatorConfig $config
         */
        return new self($config->getRegex(), $config->isStrict());
    }

    /**
     * @return RegexValidatorConfig
     */
    public function getConfig(): RegexValidatorConfig
    {
        return $this->config;
    }
}