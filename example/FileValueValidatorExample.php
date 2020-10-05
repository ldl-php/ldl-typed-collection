<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Validator\File\ReadableFileValidator;
use LDL\Type\Collection\Validator\File\Exception\FileValidatorException;
use LDL\Type\Collection\Interfaces\Validation\HasValidatorChainInterface;

class FileValueValidatorExample extends AbstractCollection implements HasValidatorChainInterface
{
    use ValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getValidatorChain()
            ->append(new ReadableFileValidator());
    }
}

echo "Create collection instance\n";

$collection = new FileValueValidatorExample();

echo "Add element test\n";

$collection->append(__FILE__);

try {

    echo "Try to add a file which does not exists, exception must be thrown\n";
    $collection->append('whatever.jpg');

}catch(FileValidatorException $e){
    echo "EXCEPTION: {$e->getMessage()}\n";
}