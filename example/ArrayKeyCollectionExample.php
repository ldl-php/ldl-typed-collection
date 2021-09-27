<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\Arrays\ArrayKeyCollection;
use LDL\Framework\Base\Contracts\Type\ToArrayKeyInterface;
use LDL\Framework\Base\Contracts\Type\ToIntegerInterface;
use LDL\Framework\Base\Contracts\Type\ToStringInterface;

class MyArrayKey implements ToArrayKeyInterface{
    public function toArrayKey(): string
    {
        return 'hello';
    }
}

class MyInteger implements ToIntegerInterface
{
    public function toInteger(): int
    {
        return 12;
    }
}

class MyAmbiguousClass implements ToIntegerInterface, ToStringInterface
{
    public function toInteger(): int
    {
        return 33;
    }

    public function toString(): string
    {
        return 'hello';
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}

echo "Create array key collection:\n\n";
$collection = new ArrayKeyCollection();

echo "Append string hello (two times):\n\n";
$collection->appendMany([
    'hello',
    'hello',
    12,
    12,
    new MyInteger(),
    new MyArrayKey()
]);

echo var_export($collection->toArray(), true)."\n\n";

echo "Append string good bye:\n\n";
$collection->append('good bye','bye');

echo var_export($collection->toArray(), true)."\n\n";

try {
    echo "Append \stdClass, exception must be thrown:\n\n";
    $collection->append(new \stdClass);
}catch(\Exception $e){
    echo "OK Exception: {$e->getMessage()}\n\n";
}

echo "Implode collection by ':':\n\n";

echo var_export($collection->implode(':'), true)."\n\n";

echo "Get unique string collection from array key collection\n";
echo var_export($collection->filterStrings()->filterUniqueStrings()->toArray(), true)."\n\n";

echo "Get integer collection from array key collection\n";
echo var_export($collection->filterIntegers()->toArray(), true)."\n\n";

echo "Filter unique integers (prefer scalar values instead of objects)\n";
echo var_export($collection->filterIntegers()->filterUniqueIntegers(false)->toArray(), true)."\n\n";

echo "Filter unique integers (prefer objects)\n";
echo var_export($collection->filterIntegers()->filterUniqueIntegers(true)->toArray(), true)."\n\n";

echo var_export($collection->toPrimitiveArray(true), true);

echo "\n\nAppend ambiguous class which implements integer and string interfaces, and try to convert to array\n";
echo "Exception MUST be thrown\n\n";

$collection->append(new MyAmbiguousClass());

try {
    $collection->toPrimitiveArray(true);
}catch(\LogicException $e){
    echo "OK EXCEPTION: {$e->getMessage()}\n\n";
}

