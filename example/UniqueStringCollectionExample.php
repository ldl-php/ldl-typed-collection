<?php declare(strict_types=1);

use LDL\Validators\Exception\TypeMismatchException;
use LDL\Type\Collection\Types\String\UniqueStringCollection;

require __DIR__.'/../vendor/autoload.php';

echo "Create unique string collection instance\n";
$str = new UniqueStringCollection();

echo "Append item with value: '123'\n";
$str->append('123');

echo "Append item with value: '234'\n";
$str->append('234');

echo "Append item with value: (integer) 789, exception must be thrown\n";

try {

    $str->append(789);

}catch(TypeMismatchException $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}

echo "Append item again with value: '123', exception must be thrown\n";

try {

    $str->append('123');

}catch(\Exception $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}