<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\String\StringCollection;

class Test implements \LDL\Framework\Base\Contracts\Type\ToStringInterface
{
    public function toString(): string
    {
        return 'Test';
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}

echo "Create string collection:\n\n";
$collection = new StringCollection();

echo "Append string hello (two times):\n\n";
$collection->appendMany([
    'hello',
    'hello',
    new Test()
]);

echo var_export($collection->toArray(), true)."\n\n";

echo "Append string good bye:\n\n";
$collection->append('good bye');

echo var_export($collection->toArray(), true)."\n\n";

try {
    echo "Append integer, exception must be thrown:\n\n";
    $collection->append(123);
}catch(\Exception $e){
    echo "OK Exception: {$e->getMessage()}\n\n";
}

echo "Implode collection by ':':\n\n";

echo var_export($collection->implode(':'), true)."\n\n";

echo "Get unique string collection:\n\n";

$unique = $collection->filterUniqueStrings();

echo var_export($unique->toArray(), true)."\n\n";

echo "Implode unique collection by ':':\n\n";

echo var_export($unique->implode(':'), true)."\n\n";
