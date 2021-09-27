<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\Object\ObjectCollection;
use LDL\Framework\Base\Contracts\Type\ToStringInterface;

class Test implements ToStringInterface
{
    public function firstMethod(){

    }

    public function toString() : string
    {
        return 'Test';
    }

    public function __toString() : string
    {
        return $this->toString();
    }
}

class Test2 {
    public function firstMethod(){}
    public function secondMethod(){}
    public function thirdMethod(){}
}

class Test3{
    public function secondMethod(){}
    public function thirdMethod(){}

    public function __toString()
    {
        return 'Test3';
    }
}

echo "Create collection:\n\n";
$collection = new ObjectCollection();

echo "Append objects Test, Test2 and Test3:\n\n";

$collection->appendMany([
    new Test(),
    new Test2(),
    new Test3()
]);

echo var_export($collection->toArray(), true)."\n\n";

echo "Filter Object Collection by method: 'firstMethod'\n\n";
echo var_export($collection->filterByMethod('firstMethod')->toArray(), true)."\n\n";

echo "Filter Object Collection by methods: 'secondMethod', 'thirdMethod'\n\n";
echo var_export($collection->filterByMethods(['secondMethod', 'thirdMethod'])->toArray(), true)."\n\n";

echo "Filter strings in Collection (only test should show up since it's the only one who implements ToStringInterface)\n\n";
echo var_export($collection->filterStrings()->toArray(), true)."\n\n";
