<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Exception\TypeMismatchException;
use LDL\Type\Collection\Types\Classes\ClassCollection;

$classCollection = new ClassCollection();

echo "Append class string \SplFileInfo::class (must be successful)\n";
$classCollection->append(SplFileInfo::class);

try {

    echo "Add NonExistentClass (EXCEPTION must be thrown)\n\n";
    $classCollection->append('NonExistentClass');

}catch(TypeMismatchException $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}