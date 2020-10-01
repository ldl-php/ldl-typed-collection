<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\Types\String\StringCollection;

$str = new StringCollection();

$str->append('123');
$str->append('456');
$str->lock();
$str->append('456');

foreach($str as $string){
    echo "String: $string"."\n";
}