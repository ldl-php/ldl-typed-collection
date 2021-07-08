<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Framework\Helper\ComparisonOperatorHelper;
use LDL\Type\Collection\Validator\Config\AmountValidatorConfig;
use LDL\Validators\Config\ValidatorConfigInterface;
use LDL\Validators\Traits\ValidatorHasConfigInterfaceTrait;
use LDL\Validators\Traits\ValidatorValidateTrait;
use LDL\Validators\ValidatorInterface;

class AmountValidator implements ValidatorInterface
{
    use ValidatorValidateTrait;
    use ValidatorHasConfigInterfaceTrait;

    /**
     * @var string|null
     */
    private $description;

    public function __construct(int $value, string $operator, string $description=null)
    {
        $this->_tConfig = new AmountValidatorConfig($value, $operator);
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        if(!$this->description){
            return sprintf(
                'The amount of items in the collection can NOT be "%s" than "%s"',
                $this->_tConfig->getOperator(),
                $this->_tConfig->getAmount()
            );
        }

        return $this->description;
    }

    public function assertTrue($value, $key = null, CollectionInterface $collection = null): void
    {
        $compare = $this->compare($collection);

        if(!$compare){
            return;
        }

        $msg = sprintf(
            'The amount of items in the collection can NOT be "%s" than "%s"',
            $this->_tConfig->getOperator(),
            $this->_tConfig->getAmount()
        );

        throw new Exception\AmountValidatorException($msg);
    }

    /**
     * @param ValidatorConfigInterface $config
     * @param string|null $description
     * @return ValidatorInterface
     * @throws Exception\InvalidConfigException
     */
    public static function fromConfig(ValidatorConfigInterface $config, string $description=null): ValidatorInterface
    {
        if(false === $config instanceof AmountValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new Exception\InvalidConfigException($msg);
        }

        /**
         * @var AmountValidatorConfig $config
         */
        return new self(
            $config->getAmount(),
            $config->getOperator(),
            $description
        );
    }

    private function compare(CollectionInterface $collection) : bool
    {
        $total = count($collection) + 1;

        switch($this->_tConfig->getOperator()){
            case ComparisonOperatorHelper::OPERATOR_SEQ:
                return $total === $this->_tConfig->getAmount();

            case ComparisonOperatorHelper::OPERATOR_EQ:
                return $total == $this->_tConfig->getAmount();

            case ComparisonOperatorHelper::OPERATOR_GT:
                return $total > $this->_tConfig->getAmount();

            case ComparisonOperatorHelper::OPERATOR_GTE:
                return $total >= $this->_tConfig->getAmount();

            case ComparisonOperatorHelper::OPERATOR_LT:
                return $total < $this->_tConfig->getAmount();

            case ComparisonOperatorHelper::OPERATOR_LTE:
                return $total <= $this->_tConfig->getAmount();

            default:
                throw new \RuntimeException('Given operator is invalid (WTF?)');
        }
    }
}
