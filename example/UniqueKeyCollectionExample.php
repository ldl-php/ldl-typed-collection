<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendKeyValidatorChainInterface;
use LDL\Framework\Base\Traits\LockableObjectInterfaceTrait;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Type\Collection\Traits\Validator\AppendKeyValidatorChainTrait;

class UniqueKeyCollectionExample extends AbstractCollection implements HasAppendKeyValidatorChainInterface
{
    use AppendKeyValidatorChainTrait;
    use LockableObjectInterfaceTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendKeyValidatorChain()
            ->append(new UniqueValidator())
            ->lock();
    }
}

echo "Create collection instance\n";
$collection = new UniqueKeyCollectionExample();

echo "Add element test with key 123\n";
$collection->append('test', '123');

echo "Add element test2 with key 123 (again) Exception must be thrown\n";
try{
    $collection->append('test2', '123');
}catch(\Exception $e){
    echo "EXCEPTION: {$e->getMessage()}\n";
}
