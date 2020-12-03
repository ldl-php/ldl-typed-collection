<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Validator\MaxAmountValidator;
use LDL\Type\Collection\Validator\Exception\AmountValidatorException;
use LDL\Type\Collection\Validator\MinimumAmountValidator;

class ItemAmountValueValidatorExample extends AbstractCollection implements HasValueValidatorChainInterface
{
    use ValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getValueValidatorChain()
            ->append(new MaxAmountValidator(5))
            ->append(new MinimumAmountValidator(3))
            ->lock();
    }
}

echo "Create new collection instance which implements ItemAmountValidator\n";
$obj = new ItemAmountValueValidatorExample();

try {

    echo "Add 5 values\n";

    $obj->append(1);
    $obj->append(2);
    $obj->append(3);
    $obj->append(4);
    $obj->append(5);

    echo "Try to add a sixth value, exception must be thrown\n";

    $obj->append(6);
}catch(AmountValidatorException $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}

try {
    echo "Try to remove last appended item, Validator minimum amount of items is set to 3\n";
    $obj->removeLast();
    echo "Item count is now: ".count($obj)."\n";

    echo "Try to remove last appended item, Validator minimum amount of items is set to 3\n";
    $obj->removeLast();
    echo "Item count is now: ".count($obj)."\n";

    echo "Try to remove one more item, exception must be thrown\n";
    $obj->removeLast();

}catch(AmountValidatorException $e){
    echo "EXCEPTION: {$e->getMessage()}\n";
}

