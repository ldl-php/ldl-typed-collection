<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\Scalar\UniqueScalarCollection;
use LDL\Framework\Base\Contracts\Type\ToScalarInterface;
use LDL\Type\Collection\Validator\Exception\DuplicateValueException;

class Test implements ToScalarInterface
{
    public function toScalar()
    {
        return 33;
    }
}

echo "Create unique scalar collection:\n\n";

$collection = new UniqueScalarCollection();

echo "Append string hello and append number 33\n\n";

$collection->appendMany([
    'hello',
    33
]);

echo var_export($collection->toArray(), true)."\n\n";

try{

    echo "Append object Test which implements ToScalarInterface and returns 33, since 33 is a duplicate value, exception must be thrown\n\n";
    $collection->append(new Test());

}catch(DuplicateValueException $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}

echo "Convert to primitive array and iterator through each value:\n\n";

foreach($collection->toPrimitiveArray(true) as $item){
    echo "Item: ".$item."\n";
}

echo "\nConvert to array and iterate through each value:\n\n";

foreach($collection->toArray() as $item){
    echo gettype($item)."\n";
}


echo $collection->implode(':')."\n";