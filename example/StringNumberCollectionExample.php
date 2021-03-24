<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Traits\Validator\AppendValidatorChainTrait;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValidatorChainInterface;
use LDL\Validators\NumberValidator;
use LDL\Validators\StringValidator;
use LDL\Validators\Chain\Exception\CombinedException;

class StringNumberCollectionExample extends AbstractCollection implements HasAppendValidatorChainInterface
{
    use AppendValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendValidatorChain()
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

}catch(CombinedException $e){

    echo "EXCEPTION: {$e->getCombinedMessage()}\n";

}