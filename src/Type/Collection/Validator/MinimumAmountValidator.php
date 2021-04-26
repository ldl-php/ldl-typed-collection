<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Type\Collection\Validator\Config\MinimumAmountValidatorConfig;
use LDL\Validators\Config\ValidatorConfigInterface;
use LDL\Validators\ValidatorInterface;

class MinimumAmountValidator implements ValidatorInterface
{
    /**
     * @var MinimumAmountValidatorConfig
     */
    private $config;

    public function __construct(int $minAmount, bool $negated=false, bool $dumpable=true)
    {
        $this->config = new MinimumAmountValidatorConfig($minAmount, $negated, $dumpable);
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
        if((count($collection) - 1) >= $this->config->getMinAmount()){
            return;
        }

        $msg = "Items in this collection must be at least: {$this->config->getMinAmount()}";

        throw new Exception\AmountValidatorException($msg);
    }

    public function assertFalse($value, $key = null, CollectionInterface $collection = null): void
    {
        if((count($collection) - 1) <= $this->config->getMinAmount()){
            return;
        }

        $msg = "Items in this collection must NOT be at least: {$this->config->getMinAmount()}";

        throw new Exception\AmountValidatorException($msg);
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
        return new self($config->getMinAmount(), $config->isNegated(), $config->isDumpable());
    }

    /**
     * @return MinimumAmountValidatorConfig
     */
    public function getConfig(): MinimumAmountValidatorConfig
    {
        return $this->config;
    }
}
