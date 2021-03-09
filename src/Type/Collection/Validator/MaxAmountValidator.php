<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Validator\Config\MaxAmountValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\AmountValidatorException;

class MaxAmountValidator implements AppendItemValidatorInterface, ValueValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var MaxAmountValidatorConfig
     */
    private $config;

    public function __construct(int $maxAmount, bool $strict=true)
    {
        $this->config = new MaxAmountValidatorConfig($maxAmount, $strict);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(count($collection) < $this->config->getMaxAmount()){
            return;
        }

        $msg = "Items in this collection can not be more than: {$this->config->getMaxAmount()}";
        throw new AmountValidatorException($msg);
    }

    /**
     * @param ValidatorConfigInterface $config
     * @return ValidatorInterface
     * @throws Exception\InvalidConfigException
     */
    public static function fromConfig(ValidatorConfigInterface $config): ValidatorInterface
    {
        if(false === $config instanceof MaxAmountValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new Exception\InvalidConfigException($msg);
        }

        /**
         * @var MaxAmountValidatorConfig $config
         */
        return new self($config->getMaxAmount(), $config->isStrict());
    }

    /**
     * @return MaxAmountValidatorConfig
     */
    public function getConfig(): MaxAmountValidatorConfig
    {
        return $this->config;
    }
}
