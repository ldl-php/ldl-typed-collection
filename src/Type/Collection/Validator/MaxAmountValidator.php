<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Exception\ArrayFactoryException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Validator\Exception\AmountValidatorException;

class MaxAmountValidator implements AppendItemValidatorInterface, ValueValidatorInterface
{
    /**
     * @var int
     */
    private $maxAmount;

    public function __construct(int $maxAmount)
    {
        if($maxAmount <= 0){
            $msg = 'Amount of items for validator "%s" must be a positive integer';
            throw new \InvalidArgumentException($msg);
        }

        $this->maxAmount = $maxAmount;
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(count($collection) < $this->maxAmount){
            return;
        }

        $msg = "Items in this collection can not be more than: {$this->maxAmount}";
        throw new AmountValidatorException($msg);
    }

    public function jsonSerialize() : array
    {
        return $this->toArray();
    }

    public static function fromArray(array $data = []): ArrayFactoryInterface
    {
        if(false === array_key_exists('maxAmount', $data)){
            $msg = sprintf("Missing property 'maxAmount' in %s", __CLASS__);
            throw new ArrayFactoryException($msg);
        }

        try{
            return new self((int) $data['maxAmount']);
        }catch(\Exception $e){
            throw new ArrayFactoryException($e->getMessage());
        }
    }

    public function toArray(): array
    {
        return [
            'class' => __CLASS__,
            'options' => [
                'maxAmount' => $this->maxAmount
            ]
        ];
    }
}
