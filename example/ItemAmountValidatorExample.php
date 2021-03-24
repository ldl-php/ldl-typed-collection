<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendValidatorChainTrait;
use LDL\Type\Collection\Validator\MaxAmountValidator;
use LDL\Type\Collection\Validator\MinimumAmountValidator;
use LDL\Type\Collection\Interfaces\Validation\HasRemoveValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\RemoveValidatorChainTrait;
use LDL\Type\Collection\Validator\Exception\AmountValidatorException;

class ItemAmountValidatorExample extends AbstractCollection implements HasAppendValidatorChainInterface, HasRemoveValidatorChainInterface
{
    use AppendValidatorChainTrait;
    use RemoveValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getAppendValidatorChain()
            ->append(new MaxAmountValidator(5))
            ->lock();

        $this->getRemoveValidatorChain()
            ->append(new MinimumAmountValidator(3))
            ->lock();
    }
}

echo "Create new collection instance which implements ItemAmountValidator\n";
$obj = new ItemAmountValidatorExample();

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

