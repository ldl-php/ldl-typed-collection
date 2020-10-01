<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasKeyValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\KeyValidatorChainTrait;
use LDL\Type\Collection\Validator\RegexKeyValidator;
use LDL\Type\Collection\Exception\CollectionKeyException;

class RegexKeyValidatorExample extends AbstractCollection implements HasKeyValidatorChainInterface
{
    use KeyValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getKeyValidatorChain()
            ->append(new RegexKeyValidator('#[0-9]+#', true));
    }
}

echo "Create collection instance\n";

$collection  = new RegexKeyValidatorExample();

echo "Add element test with key 213\n";
$collection->append('test', 123);


echo "Add element test 3 with key 456\n";
$collection->append('test 3', 456);

try {

    echo "Try to add element asd, with a key which doesn't matches regex #[0-9]#+\n";
    $collection->append('abc', 'def');

}catch(CollectionKeyException $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}