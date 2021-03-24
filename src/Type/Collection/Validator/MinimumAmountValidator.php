<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Type\Collection\Validator\Config\MinimumAmountValidatorConfig;
use LDL\Type\Collection\Validator\Exception\AmountValidatorException;
use LDL\Validators\Config\ValidatorConfigInterface;
use LDL\Validators\HasValidatorConfigInterface;
use LDL\Validators\ValidatorInterface;

class MinimumAmountValidator implements ValidatorInterface, HasValidatorConfigInterface
{
    /**
     * @var MinimumAmountValidatorConfig
     */
    private $config;

    public function __construct(int $minAmount, bool $strict=true)
    {
        $this->config = new MinimumAmountValidatorConfig($minAmount, $strict);
    }

    public function validate($item, $key = null, CollectionInterface $collection = null): void
    {
        if((count($collection) - 1) >= $this->config->getMinAmount()){
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
