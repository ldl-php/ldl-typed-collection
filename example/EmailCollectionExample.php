<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';
use LDL\Type\Collection\Types\Email\EmailCollection;

echo "Create new EmailCollection instance with the following values:\n\n";

$values = [
    'test@mail.com',
    'test1@test.com'
];

echo var_export($values, true)."\n\n";

$collection = new EmailCollection($values);

echo "Convert to array:\n\n";

echo var_export($collection->toArray(), true)."\n\n";

$invalid = 'hello@.com';

echo "Try to add an invalid email ($invalid), EXCEPTION must be thrown:\n\n";

try {
    $collection->append('hello.com');
}catch(\Exception $e){
    echo "EXCEPTION: {$e->getMessage()}\n\n";
}