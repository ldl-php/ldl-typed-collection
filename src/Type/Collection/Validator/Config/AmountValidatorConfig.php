<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator\Config;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Exception\ArrayFactoryException;
use LDL\Framework\Helper\ComparisonOperatorHelper;
use LDL\Validators\Config\Traits\ValidatorConfigTrait;
use LDL\Validators\Config\ValidatorConfigInterface;

class AmountValidatorConfig implements ValidatorConfigInterface
{
    use ValidatorConfigTrait;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var string
     */
    private $operator;

    public function __construct(int $amount, string $operator)
    {
        if($amount <= 0){
            $msg = 'Amount of items for validator "%s" must be a positive integer';
            throw new \InvalidArgumentException($msg);
        }

        ComparisonOperatorHelper::validate($operator);

        $this->amount = $amount;
        $this->operator = $operator;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @param array $data
     * @return ArrayFactoryInterface
     * @throws ArrayFactoryException
     */
    public static function fromArray(array $data = []): ArrayFactoryInterface
    {
        if(!array_key_exists('amount', $data)){
            $msg = sprintf("Missing property 'amount' in %s", __CLASS__);
            throw new ArrayFactoryException($msg);
        }

        if(!array_key_exists('operator', $data)){
            $msg = sprintf("Missing property 'operator' in %s", __CLASS__);
            throw new ArrayFactoryException($msg);
        }

        if(!is_string($data['operator'])){
            throw new \InvalidArgumentException(
                sprintf('operator must be of type string, "%s" was given',gettype($data['operator']))
            );
        }

        try{
            return new self(
                (int) $data['amount'],
                array_key_exists('operator', $data) ? $data['operator'] : false
            );
        }catch(\Exception $e){
            throw new ArrayFactoryException($e->getMessage());
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'operator' => $this->operator
        ];
    }
}