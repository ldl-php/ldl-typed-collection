<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Type\Collection\Exception\CollectionValueException;

class UniqueValueValueValidatorExample extends AbstractCollection implements \LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface {

    use ValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getValueValidatorChain()
            ->append(new UniqueValidator());
    }
}

echo "Create collection instance\n";

$collection = new UniqueValueValueValidatorExample();

echo "Add element test\n";

$collection->append('test');

try {

    echo "Try to add element with the same value 'test'\n";
    $collection->append('test');

}catch(CollectionValueException $e){
    echo "EXCEPTION: {$e->getMessage()}\n";
}