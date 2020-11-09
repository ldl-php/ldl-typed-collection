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

foreach($collection->filterByClass(Test2::class) as $key => $item){
    echo get_class($item)."\n";
}

echo "Filter collection by classes Test1, Test3\n";

/**
 * @var ObjectCollection $filtered
 */
$filtered = $collection->filterByClasses([Test1::class, Test3::class]);

foreach($filtered as $key => $item){
    echo "$key => ".\get_class($item)."\n";
}

echo "Remove one item (0) Test 1 from the filtered collection\n";

$filtered->remove(0);

echo "Try to filter by class again with class Test1, result must be empty\n";

foreach($filtered->filterByClass(Test1::class) as $key => $item){
    echo "$key => ".\get_class($item)."\n";
}

echo "Try to filter by class again with class Test3, class Test3 must *show up*\n";

foreach($filtered->filterByClass(Test3::class) as $key => $item){
    echo "$key => ".\get_class($item)."\n";
}