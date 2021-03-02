<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\KeyValidatorChainTrait;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Type\Collection\Exception\CollectionValueException;

class UniqueValidatorExample extends AbstractCollection implements HasKeyValidatorChainInterface, HasValueValidatorChainInterface
{
    use KeyValidatorChainTrait;
    use ValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getKeyValidatorChain()
            ->append(new UniqueValidator());

        $this->getValueValidatorChain()
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