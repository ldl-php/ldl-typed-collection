<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Validators\IntegerValidator;
use LDL\Validators\NumericRangeValidator;

class MyIntegerCollection extends AbstractCollection implements HasAppendValueValidatorChainInterface
{
    use AppendValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendValueValidatorChain()
            ->append(new IntegerValidator(true))
            ->append(new NumericRangeValidator(100,599));
    }
}

echo "Create MyIntegerCollection instance\n\n";

$collection  = new MyIntegerCollection();

echo "Append string item: 'hello' (exception must be thrown)\n\n";

try{
    $collection->append('hello');
}catch(\Exception $e){
    echo "EXCEPTION: {$e->getMessage()}\n\n";
}

echo "Append integer number 200, (no error must show up)\n\n";
$collection->append(200);

try {

    echo "Append integer number 99, (exception must be thrown)\n\n";
    $collection->append(99);

}catch(\Exception $e){

    echo "EXCEPTION: {$e->getMessage()}\n\n";

}

echo "Append integer number 599, (no error must show up)\n\n";
$collection->append(599);

try {

    echo "Append integer number 600, (exception must be thrown)\n\n";
    $collection->append(600);

}catch(\Exception $e){

    echo "EXCEPTION: {$e->getMessage()}\n\n";

}

