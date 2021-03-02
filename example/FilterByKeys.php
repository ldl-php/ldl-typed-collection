<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\String\StringCollection;

$str = new StringCollection();

echo "Append item with key 'a' and value: '123'\n";
$str['a'] = '123';

echo "Append item with key: 'b' and value: '456'\n";
$str['b'] =  '456';

echo "Append item with key: 'c' and value: '678'\n";
$str['c'] =  '678';

$filter = new StringCollection();
$filter->append('a')
    ->append('b');

echo "Filter by keys 'a' and 'b' (c must not be there)\n";
$str = $str->filterByKeys($filter);

foreach($str as $string){
    echo "String: $string"."\n";
}

if($str->count() > 2){
    throw new \Exception("INVALID COUNT \"{$str->count()}\" Count must be 2 as 2 items were selected");
}