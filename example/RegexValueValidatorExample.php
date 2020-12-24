<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\KeyValidatorChainTrait;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Validator\RegexValidator;
use LDL\Type\Collection\Validator\Exception\RegexValidatorException;

class RegexValueValidatorExample extends AbstractCollection implements HasKeyValidatorChainInterface, HasValueValidatorChainInterface
{
    use KeyValidatorChainTrait;
    use ValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getKeyValidatorChain()
            ->append(new RegexValidator('#[0-9]+#', true));

        $this->getValueValidatorChain()
            ->append(new RegexValidator('#[0-9]+#', true));
    }
}

echo "In this example, both key and value must comply to regex #[0-9]+#\n\n";

echo "Create collection instance\n";

$collection  = new RegexValueValidatorExample();

echo "Add element with value 2 and key 1\n";
$collection->append(2, 1);

echo "Add element with value 3 and key 2\n";
$collection->append(3, 2);

echo "\nValidate KEY:\n";

try {

    echo "Try to add element 111, with key \"def\" which doesn't matches regex #[0-9]#+\n";
    $collection->append(111, 'def');

}catch(RegexValidatorException $e){

    echo "EXCEPTION: {$e->getMessage()}\n\n";

}

echo "Validate VALUE:\n";

try {

    echo "Try to add element \"def\", with key 111 which doesn't matches regex #[0-9]#+\n";
    $collection->append('def', 111);

}catch(RegexValidatorException $e){

    echo "EXCEPTION: {$e->getMessage()}\n\n";

}