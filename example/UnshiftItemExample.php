<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\String\StringCollection;

$str = new StringCollection();

echo "Append item with value: '123'\n";
$str->append('123','b');

echo "Append item with value: '456'\n";
$str->append('456','a');

echo "Iterate through elements:\n";

foreach($str as $string){
    echo "String: $string"."\n";
}

echo "Call unshift, append \"I am first\" string\n";
$str->unshift('I am first','c');


echo "Iterate through elements (I am first must appear FIRST and have the key: 0):\n";

foreach($str as $k=>$string){
    echo "Key: $k, String: $string"."\n";
}

echo "First key is (c must be the output):\n";
echo "{$str->getFirstKey()}\n";

echo "Last key is (a must be the output):\n";
echo "{$str->getLastKey()}\n";