<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Validators\RegexValidator;
use LDL\Type\Collection\Interfaces\Validation\HasAppendKeyValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendKeyValidatorChainTrait;
use LDL\Validators\Exception\RegexValidatorException;

class RegexValueValidatorExample extends AbstractCollection implements HasAppendValueValidatorChainInterface, HasAppendKeyValidatorChainInterface
{
    use AppendValueValidatorChainTrait;
    use AppendKeyValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendValueValidatorChain()
            ->append(new RegexValidator('#[0-9]+#'));

        $this->getAppendKeyValidatorChain()
            ->append(new RegexValidator('#[0-9]+#'));
    }
}

echo "In this example, both key and value must comply to regex #[0-9]+#\n\n";

echo "Create collection instance\n";

$collection  = new RegexValueValidatorExample();

echo "Add element with value: 2 and key: 1\n";
$collection->append(2, 1);

echo "Add element with value: 3 and key: 2\n";
$collection->append(3, 2);

echo "Validate KEY:\n";

try {

    echo "Try to add element 111, with key \"def\" which doesn't matches regex #[0-9]+#\n";
    $collection->append(111, 'def');

}catch(RegexValidatorException $e){

    echo "EXCEPTION: {$e->getMessage()}\n\n";

}

echo "Validate VALUE:\n";

try {

    echo "Try to add element \"def\" which doesn't matches regex #[0-9]+#, with key 111\n";
    $collection->append('def', 111);

}catch(RegexValidatorException $e){

    echo "EXCEPTION: {$e->getMessage()}\n\n";

}
