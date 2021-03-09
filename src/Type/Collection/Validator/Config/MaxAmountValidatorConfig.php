<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator\Config;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Exception\ArrayFactoryException;

class MaxAmountValidatorConfig implements ValidatorConfigInterface
{
    use ValidatorConfigInterfaceTrait;

    /**
     * @var int
     */
    private $maxAmount;

    public function __construct(int $maxAmount, bool $strict=true)
    {
        if($maxAmount <= 0){
            $msg = 'Amount of items for validator "%s" must be a positive integer';
            throw new \InvalidArgumentException($msg);
        }

        $this->_isStrict = $strict;

        $this->maxAmount = $maxAmount;
    }

    /**
     * @return int
     */
    public function getMaxAmount(): int
    {
        return $this->maxAmount;
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return $this->toArray();
    }

    /**
     * @param array $data
     * @return ArrayFactoryInterface
     * @throws ArrayFactoryException
     */
    public static function fromArray(array $data = []): ArrayFactoryInterface
    {
        if(false === array_key_exists('maxAmount', $data)){
            $msg = sprintf("Missing property 'maxAmount' in %s", __CLASS__);
            throw new ArrayFactoryException($msg);
        }

        try{
            return new self((int) $data['maxAmount'], array_key_exists('strict', $data) ? (bool)$data['strict'] : true);
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
            'maxAmount' => $this->maxAmount,
            'strict' => $this->_isStrict
        ];
    }
}