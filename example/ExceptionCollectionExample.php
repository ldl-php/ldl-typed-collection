<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\Exception\ExceptionCollection;

class MyException extends \Exception
{
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

class SimpleClass
{
    public function __construct()
    {

    }
}

echo "Create ExceptionCollection instance\n\n";

$collection  = new ExceptionCollection();

echo "Append exception MyException\n\n";

$collection->append(new MyException('MyExceptionMessage'));

try {

    echo "Append integer number 99, (exception must be thrown)\n\n";
    $collection->append(99);

}catch(\Exception $e){

    echo "EXCEPTION: {$e->getMessage()}\n\n";

}

try {

    echo "Append Object that is not an Exception, (exception must be thrown)\n\n";
    $collection->append(new SimpleClass());

}catch(\Exception $e){

    echo "EXCEPTION: {$e->getMessage()}\n\n";

}

echo "Convert list of exceptions to JSON\n\n";

echo json_encode($collection);

echo "\n\nConvert list of exceptions to Array\n\n";

var_dump($collection->toArray());