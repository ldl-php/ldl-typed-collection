<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';
use LDL\Type\Collection\Types\Classes\ClassCollection;

class Test {

}

echo "Create new ClassCollection instance\n";
$collection = new ClassCollection();

echo "Append class Test as a regular string:\n";
$collection->append('Test');

echo var_export(iterator_to_array($collection,true))."\n";

echo "Append class Test including global namespace:\n";
$collection->append(Test::class);

echo var_export(iterator_to_array($collection,true))."\n\n";

try {
    echo "Append non-existing class as string NonExistingClass, (exception must be thrown)\n\n";
    $collection->append('NonExistingClass');
}catch(\Exception $e){
    echo "OK: Exception: {$e->getMessage()}\n\n";
}


