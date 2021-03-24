<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\String\StringCollection;
use LDL\Validators\Exception\TypeMismatchException;

$str = new StringCollection();

echo "Append item with value: '123'\n";
$str[] = '123';

echo "Append item with value: '456'\n";
$str[] =  '456';

echo "Replace item 0 with integer value 789, exception must be thrown\n";


try {

    $str[0] = 789;

}catch(TypeMismatchException $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}

echo "Iterate through elements:\n";

foreach($str as $string){
    echo "String: $string"."\n";
}