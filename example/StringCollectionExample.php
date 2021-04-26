<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\String\StringCollection;

$str = new StringCollection();

echo "Append item with value: '123'\n";
$str->append('123');

echo "Append item with value: '123'\n";
$str->append('123');

echo "Append item with value: '456'\n";
$str->append('456');

echo "Append item with value: (integer) 789, exception must be thrown\n";

try {

    $str->append(789);

}catch(\Exception $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}

echo "Iterate through elements:\n";

foreach($str as $string){
    echo "String: $string"."\n";
}

echo "Get unique values from collection:\n";
$uniques = $str->toUnique();

echo "Iterate through uniques values:\n";

foreach($uniques as $unique){
    echo "String: $unique"."\n";
}

echo "Call Implode:\n\n";

echo $str->implode(',');

echo "\nAdd new element \"000\" and call implode again\n\n";

$str->append('000');
echo $str->implode(',');

echo "\nRemove element and call implode again\n\n";

$str->removeByValue('000');

echo $str->implode(',');
