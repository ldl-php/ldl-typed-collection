<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\RemoveItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Validator\Config\MinimumAmountValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\AmountValidatorException;

class MinimumAmountValidator implements RemoveItemValidatorInterface, ValueValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var MinimumAmountValidatorConfig
     */
    private $config;

    public function __construct(int $minAmount, bool $strict=true)
    {
        $this->config = new MinimumAmountValidatorConfig($minAmount, $strict);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(count($collection) > $this->config->getMinAmount()){
            return;
        }

        $msg = "Items in this collection must be at least: {$this->config->getMinAmount()}";

        throw new AmountValidatorException($msg);
    }

    /**
     * @param ValidatorConfigInterface $config
     * @return ValidatorInterface
     * @throws Exception\InvalidConfigException
     */
    public static function fromConfig(ValidatorConfigInterface $config): ValidatorInterface
    {
        if(false === $config instanceof MinimumAmountValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new Exception\InvalidConfigException($msg);
        }

        /**
         * @var MinimumAmountValidatorConfig $config
         */
        return new self($config->getMinAmount(), $config->isStrict());
    }

    /**
     * @return MinimumAmountValidatorConfig
     */
    public function getConfig(): MinimumAmountValidatorConfig
    {
        return $this->config;
    }
}
