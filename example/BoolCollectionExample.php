<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';
use LDL\Type\Collection\Types\Bool\BoolCollection;

echo "Create new BoolCollection instance with the following values:\n\n";

$values = [
    'true_val' => true,
    'false_val' => false
];

echo var_export($values, true)."\n\n";

$collection = new BoolCollection($values);

echo "Convert to array:\n\n";

echo var_export($collection->toArray(), true)."\n\n";

echo "Try to add an integer value, EXCEPTION must be thrown:\n\n";

try {
    $collection->append(1);
}catch(\Exception $e){
    echo "EXCEPTION: {$e->getMessage()}\n\n";
}