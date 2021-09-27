<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\Scalar\ScalarCollection;
use LDL\Framework\Base\Contracts\Type\ToScalarInterface;
use LDL\Framework\Base\Contracts\Type\ToStringInterface;

echo "Create scalar collection:\n\n";

class MyScalar implements ToScalarInterface
{
    public function toScalar()
    {
        return 'hello';
    }
}

$collection = new ScalarCollection();

echo "Append string hello (two times):\n\n";
$collection->appendMany([
    'hello',
    'hello',
    true,
    new MyScalar()
]);

echo var_export($collection->toArray(), true)."\n\n";

echo "Append string good bye:\n\n";
$collection->append('good bye');

echo var_export($collection->toArray(), true)."\n\n";

echo "Append integer 123:\n\n";
$collection->append(123);

echo "Implode collection by ':':\n\n";

echo var_export($collection->implode(':'), true)."\n\n";

echo "Get unique scalar collection (prefer objects: true)\n\n";
$unique = $collection->filterUniqueScalars();
echo var_export($unique->toArray(), true)."\n\n";

echo "Implode unique collection by ':':\n\n";

echo var_export($unique->implode(':'), true)."\n\n";

echo "Get unique scalar collection (prefer objects: false)\n\n";
$unique = $collection->filterUniqueScalars(false);
echo var_export($unique->toArray(), true)."\n\n";

