<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendKeyValidatorChainTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Validator\UniqueValidator;

class UniqueValueValidatorExample extends AbstractCollection implements HasAppendKeyValidatorChainInterface, HasAppendValueValidatorChainInterface
{
    use AppendKeyValidatorChainTrait;
    use AppendValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendKeyValidatorChain()
            ->append(new UniqueValidator());

        $this->getAppendValueValidatorChain()
            ->append(new UniqueValidator());
    }
}

echo "Create collection instance\n";

$collection = new UniqueValueValidatorExample();

echo "Add element test with key 213\n";

$collection->append('test', '213');

try {

    echo "Try to add element with value 'some value' and key '213' AGAIN, Exception must be thrown\n";
    $collection->append('some value', '213');

}catch(\Exception $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}

try{

    echo "Try to add element test, AGAIN, exception must be thrown\n";
    $collection->append('test');

}catch(\Exception $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}