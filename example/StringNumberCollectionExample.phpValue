<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Types\String\Validator\StringValidator;
use LDL\Type\Collection\Types\Number\Validator\NumberValidator;
use LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface;
use LDL\Type\Collection\Validator\Exception\ValidatorChainSoftValidationException;

class StringNumberCollectionExample extends AbstractCollection implements HasValueValidatorChainInterface
{
    use ValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValueValidatorChain()
            ->append(new NumberValidator(false))
            ->append(new StringValidator(false));
    }
}

echo "Create string/number collection instance\n";

$collection  = new StringNumberCollectionExample();

echo "Append string item: 'hello'\n";
$collection->append('hello');

echo "Append number item: 123\n";
$collection->append(123);

try {

    echo "Try to add an object, exception must be thrown\n\n";
    $collection->append(new \stdClass());

}catch(ValidatorChainSoftValidationException $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}