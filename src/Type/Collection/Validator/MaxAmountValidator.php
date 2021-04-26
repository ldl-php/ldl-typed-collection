<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Type\Collection\Validator\Config\MaxAmountValidatorConfig;
use LDL\Validators\Config\ValidatorConfigInterface;
use LDL\Validators\ValidatorInterface;

class MaxAmountValidator implements ValidatorInterface
{
    /**
     * @var MaxAmountValidatorConfig
     */
    private $config;

    public function __construct(int $maxAmount, bool $negated=false, bool $dumpable=true)
    {
        $this->config = new MaxAmountValidatorConfig($maxAmount, $negated, $dumpable);
    }

    /**
     * @param mixed $value
     * @param null $key
     * @param CollectionInterface|null $collection
     * @throws Exception\AmountValidatorException
     */
    public function validate($value, $key = null, CollectionInterface $collection = null): void
    {
        $this->config->isNegated() ? $this->assertFalse($value, $key, $collection) : $this->assertTrue($value, $key, $collection);
    }

    public function assertTrue($value, $key = null, CollectionInterface $collection = null): void
    {
        if((count($collection) + 1) <= $this->config->getMaxAmount()){
            return;
        }

        $msg = "Items in this collection can NOT be more than: {$this->config->getMaxAmount()}";
        throw new Exception\AmountValidatorException($msg);
    }

    public function assertFalse($value, $key = null, CollectionInterface $collection = null): void
    {
        if((count($collection) + 1) > $this->config->getMaxAmount()){
            return;
        }

        $msg = "Items in this collection can be more than: {$this->config->getMaxAmount()}";
        throw new Exception\AmountValidatorException($msg);
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
        return new self($config->getMaxAmount(), $config->isNegated(), $config->isDumpable());
    }

    /**
     * @return MaxAmountValidatorConfig
     */
    public function getConfig(): MaxAmountValidatorConfig
    {
        return $this->config;
    }
}
