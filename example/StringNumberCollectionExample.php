<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Types\String\Validator\StringItemValidator;
use LDL\Type\Collection\Types\Number\Validator\NumberValidator;
use LDL\Type\Collection\Interfaces\Validation\HasValidatorChainInterface;
use LDL\Type\Collection\Validator\Exception\ValidatorChainSoftValidationException;

class StringNumberCollectionExample extends AbstractCollection implements HasValidatorChainInterface
{
    use ValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValidatorChain()
            ->append(new NumberValidator(false))
            ->append(new StringItemValidator(false));
    }
}

echo "Create collection instance\n";

$collection  = new StringNumberCollectionExample();

try {

    echo "Try to add an object, exception must be thrown\n\n";
    $collection->append(new \stdClass());

}catch(ValidatorChainSoftValidationException $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}