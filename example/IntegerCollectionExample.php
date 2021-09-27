<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\Integer\IntegerCollection;

echo "Create integer collection:\n\n";
$collection = new IntegerCollection();

echo "Append integer 10 (two times):\n\n";

$collection->appendMany([
    10,
    10
]);

echo var_export($collection->toArray(), true)."\n\n";

echo "Append negative integer -100:\n\n";
$collection->append(-100);

echo var_export($collection->toArray(), true)."\n\n";

try {
    echo "Append string '123test', exception must be thrown:\n\n";
    $collection->append('123test');
}catch(\Exception $e){
    echo "OK Exception: {$e->getMessage()}\n\n";
}

try {
    echo "Append double 9e99 exception must be thrown:\n\n";
    $collection->append(9e99);
}catch(\Exception $e){
    echo "OK Exception: {$e->getMessage()}\n\n";
}

echo "Get unsigned collection:\n\n";
$unsigned = $collection->filterUnsignedIntegers();

echo var_export($unsigned->toArray(), true)."\n\n";

if(count($unsigned) !== 2){
    throw new \RuntimeException('BUG: Element count must be equal to 2!');
}

echo "Get UNIQUE collection from unsigned collection:\n\n";

$unsignedUnique = $unsigned->filterUniqueIntegers();

echo var_export($unsignedUnique->toArray(), true)."\n\n";
