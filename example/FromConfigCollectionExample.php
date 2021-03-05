<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\KeyValidatorChainTrait;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Type\Collection\Validator\ValueValidatorChain;

class FromConfigCollectionExample extends AbstractCollection implements HasKeyValidatorChainInterface, HasValueValidatorChainInterface
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

class CollectionsDiffer extends \Exception
{

}

echo "Create collection instance\n";

$collection = new FromConfigCollectionExample();

echo "Add element test with key 213\n";

$collection->append('test', '213');

echo "Create collection instance from config\n";

$fromConfig = ValueValidatorChain::fromConfig($collection->getValueValidatorChain()->getConfig());

$same = count($fromConfig) === count($collection->getValueValidatorChain()->getConfig());

if(false === $same){
    throw new CollectionsDiffer('Collections are not the same');
}

echo "Items on both collections must be the same: OK\n";


