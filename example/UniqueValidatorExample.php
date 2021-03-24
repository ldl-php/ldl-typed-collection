<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendKeyValidatorChainTrait;
use LDL\Type\Collection\Traits\Validator\AppendValidatorChainTrait;
use LDL\Type\Collection\Exception\CollectionValueException;
use LDL\Type\Collection\Validator\UniqueValidator;

class UniqueValidatorExample extends AbstractCollection implements HasAppendKeyValidatorChainInterface, HasAppendValidatorChainInterface
{
    use AppendKeyValidatorChainTrait;
    use AppendValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendKeyValidatorChain()
            ->append(new UniqueValidator());

        $this->getAppendValidatorChain()
            ->append(new UniqueValidator());
    }
}

echo "Create collection instance\n";

$collection = new UniqueValidatorExample();

echo "Add element test with key 213\n";

$collection->append('test', '213');

try {

    echo "Try to add element with value 'some value' and key '213' AGAIN, Exception must be thrown\n";
    $collection['213'] = 'some value';

}catch(\Exception $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}

try{

    echo "Try to add element test, AGAIN, exception must be thrown\n";
    $collection->append('test');

}catch(CollectionValueException $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}