<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Exception\ArrayFactoryException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\RemoveItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Validator\Exception\AmountValidatorException;

class MinimumAmountValidator implements RemoveItemValidatorInterface, ValueValidatorInterface

{
    /**
     * @var int
     */
    private $minAmount;

    public function __construct(int $minAmount)
    {
        if($minAmount <= 0){
            $msg = 'Amount of items for validator "%s" must be a positive integer';
            throw new \InvalidArgumentException($msg);
        }

        $this->minAmount = $minAmount;
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(count($collection) > $this->minAmount){
            return;
        }

        $msg = "Items in this collection must be at least: {$this->minAmount}";

        throw new AmountValidatorException($msg);
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
        if(false === array_key_exists('minAmount', $data)){
            $msg = sprintf("Missing property 'minAmount' in %s", __CLASS__);
            throw new ArrayFactoryException($msg);
        }

        try{
            return new self((int) $data['minAmount']);
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
            'class' => __CLASS__,
            'options' => [
                'minAmount' => $this->minAmount
            ]
        ];
    }
}
