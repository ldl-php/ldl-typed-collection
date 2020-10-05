<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\RemoveItemValidatorInterface;
use LDL\Type\Collection\Validator\Exception\AmountValidatorException;

class MinimumItemAmountValidator implements RemoveItemValidatorInterface
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

    public function validate(CollectionInterface $collection, $item, $key): void
    {
        if(count($collection) > $this->minAmount){
            return;
        }

        $msg = "Items in this collection must be at least: {$this->minAmount}";

        throw new AmountValidatorException($msg);
    }
}
