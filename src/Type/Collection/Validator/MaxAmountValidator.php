<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Type\Collection\Validator\Config\MaxAmountValidatorConfig;
use LDL\Type\Collection\Validator\Exception\AmountValidatorException;
use LDL\Validators\Config\ValidatorConfigInterface;
use LDL\Validators\HasValidatorConfigInterface;
use LDL\Validators\ValidatorInterface;

class MaxAmountValidator implements ValidatorInterface, HasValidatorConfigInterface
{
    /**
     * @var MaxAmountValidatorConfig
     */
    private $config;

    public function __construct(int $maxAmount, bool $strict=true)
    {
        $this->config = new MaxAmountValidatorConfig($maxAmount, $strict);
    }

    /**
     * @param mixed $item
     * @param null $key
     * @param CollectionInterface|null $collection
     * @throws AmountValidatorException
     */
    public function validate($item, $key = null, CollectionInterface $collection = null): void
    {
        if((count($collection) + 1) <= $this->config->getMaxAmount()){
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
