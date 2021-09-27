<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\Numeric\NumericCollection;
use LDL\Framework\Base\Contracts\Type\ToNumericInterface;

class MyNumber implements ToNumericInterface
{
    public function toNumeric()
    {
        return 30.5;
    }
}

echo "Create numeric collection:\n\n";
$collection = new NumericCollection();

echo "Append double 30.5 (two times) 100, -100, -9e99, 9e99 and MyNumber (containing 30.5):\n\n";

$collection->appendMany([
    30.5,
    30.5,
    new MyNumber(),
    100,
    -100,
    -9e99,
    9e99,
]);

echo var_export($collection->toArray(), true)."\n\n";

try {
    echo "Append string '123test', exception must be thrown:\n\n";
    $collection->append('123test');
}catch(\Exception $e){
    echo "OK Exception: {$e->getMessage()}\n\n";
}

echo "Get unsigned collection:\n\n";
$unsigned = $collection->filterUnsignedNumbers();

echo var_export($unsigned->toArray(), true)."\n\n";

if(count($unsigned) !== 5){
    throw new \RuntimeException('BUG: Element count must be equal to 5!');
}

echo "Get UNIQUE collection from unsigned collection (prefer objects):\n\n";

$unsignedUnique = $unsigned->filterUniqueNumbers();

echo var_export($unsignedUnique->toArray(), true)."\n\n";

echo "Get UNIQUE collection from unsigned collection (prefer primitive values):\n\n";

$unsignedUnique = $unsigned->filterUniqueNumbers(false);

echo var_export($unsignedUnique->toArray(), true)."\n\n";

