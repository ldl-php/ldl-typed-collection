<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Types\Object\ObjectCollection;
use LDL\Type\Collection\Types\String\Validator\StringItemValidator;

class ClassNameFilterExample extends ObjectCollection
{

}

class Test1 extends AbstractCollection implements HasValidatorChainInterface
{
    use ValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValidatorChain()
            ->append(new StringItemValidator(false));
    }
}

class Test2 extends AbstractCollection implements HasValidatorChainInterface
{
    use ValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValidatorChain()
            ->append(new StringItemValidator(false));
    }
}

class Test3 extends AbstractCollection implements HasValidatorChainInterface
{
    use ValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValidatorChain()
            ->append(new StringItemValidator(false));
    }
}

$test1 = new Test1();
$test2 = new Test2();
$test3 = new Test3();

$test1->append('1');
$test2->append('2');
$test3->append('3');

echo "Create collection instance\n";

$collection = new ClassNameFilterExample();
$collection->append($test1);
$collection->append($test2);
$collection->append($test3);

echo "Iterate through the collection\n";

foreach($collection as $item){
    echo get_class($item)."\n";
}

echo "Filter collection by class Test2\n";

foreach($collection->filterByClass('Test2') as $key => $item){
    echo get_class($item)."\n";
}

echo "Filter collection by classes Test1, Test3\n";

foreach($collection->filterByClasses(['Test1', 'Test3']) as $key => $item){
    echo get_class($item)."\n";
}