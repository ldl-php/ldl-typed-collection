<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\Double\DoubleCollection;
use LDL\Framework\Base\Contracts\Type\ToDoubleInterface;

class MyDouble implements ToDoubleInterface{
    public function toDouble(): float
    {
        return 0.1;
    }
}

echo "Create double collection:\n\n";
$collection = new DoubleCollection();

echo "Append double 0.1 (two times):\n\n";

$collection->appendMany([
    0.1,
    0.1,
    new MyDouble()
]);

echo var_export($collection->toArray(), true)."\n\n";

echo "Append scientific notated negative number -9e99:\n\n";
$collection->append(-9e99);

echo var_export($collection->toArray(), true)."\n\n";

try {
    echo "Append string 'hello', exception must be thrown:\n\n";
    $collection->append('hello');
}catch(\Exception $e){
    echo "OK Exception: {$e->getMessage()}\n\n";
}

try {
    echo "Append integer exception must be thrown:\n\n";
    $collection->append(1);
}catch(\Exception $e){
    echo "OK Exception: {$e->getMessage()}\n\n";
}

echo "Get unsigned collection:\n\n";
$unsigned = $collection->filterUnsignedDoubles();

echo var_export($unsigned->toArray(), true)."\n\n";

if(count($unsigned) !== 3){
    throw new \RuntimeException('BUG: Element count must be equal to 2!');
}

echo "Get UNIQUE collection from unsigned collection (prefer object values):\n\n";

$unsignedUnique = $unsigned->filterUniqueDoubles();

echo var_export($unsignedUnique->toArray(), true)."\n\n";


echo "Get UNIQUE collection from unsigned collection (prefer scalar values):\n\n";

$unsignedUnique = $unsigned->filterUniqueDoubles(false);

echo var_export($unsignedUnique->toArray(), true)."\n\n";
