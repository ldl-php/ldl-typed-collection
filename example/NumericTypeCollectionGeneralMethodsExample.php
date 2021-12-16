<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Types\Double\DoubleCollection;
use LDL\Framework\Base\Contracts\Type\ToDoubleInterface;
use LDL\Type\Collection\Types\Integer\IntegerCollection;
use LDL\Type\Collection\Types\Numeric\NumericCollection;
use LDL\Framework\Base\Contracts\Type\ToIntegerInterface;
use LDL\Framework\Base\Contracts\Type\ToNumericInterface;

class IntegerClass implements ToIntegerInterface
{
    public function toInteger(): int
    {
        return 14;
    }
}

class DoubleClass implements ToDoubleInterface
{
    public function toDouble(): float
    {
        return 26.29;
    }
}

class NumericClassHavingInteger implements ToNumericInterface
{
    public function toNumeric()
    {
        return 1;
    }
}

class NumericClassHavingDouble implements ToNumericInterface
{
    public function toNumeric()
    {
        return 45.03;
    }
}

echo "Create integer collection:\n\n";
$integerCollection = new IntegerCollection();

echo "Append integers and object having interface ToIntegerInterface:\n\n";

$items = [
    10,
    21,
    15,
    50,
    new IntegerClass
];

$integerCollection->appendMany($items);

echo var_export($items, true) . "\n\n";

echo "Get sum of an IntegerCollection:\n\n";

echo $integerCollection->sum() . "\n\n";

echo "Create double collection:\n\n";
$doubleCollection = new DoubleCollection();

echo "Append doubles and object having interface ToDoubleInterface:\n\n";

$items = [
    5.98,
    0.26,
    new DoubleClass,
];

$doubleCollection->appendMany($items);

echo var_export($items, true) . "\n\n";

echo "Get sum of a DoubleCollection:\n\n";

echo $doubleCollection->sum() . "\n\n";

echo "Create numeric collection:\n\n";
$numericCollection = new NumericCollection();

echo "Append numeric values and object having interface toNumeric:\n\n";

$items = [
    5.98,
    50,
    67,
    10,
    new NumericClassHavingInteger,
    new NumericClassHavingDouble
];

$numericCollection->appendMany($items);

echo var_export($items, true) . "\n\n";

echo "Get sum of a NumericCollection:\n\n";

echo $numericCollection->sum() . "\n\n";

echo "Get an average on of an IntegerCollection:\n\n";

echo $integerCollection->avg() . "\n\n";

echo "Get lowest value of an IntegerCollection:\n\n";

echo $integerCollection->lowest() . "\n\n";

echo "Get highest value of an IntegerCollection:\n\n";

echo $integerCollection->highest() . "\n\n";

echo "Get IntegerCollection with even values:\n\n";

echo var_export($integerCollection->filterEven()->toPrimitiveArray(true), true) . "\n\n";

echo "Get NumericCollection with odd values:\n\n";

echo var_export($numericCollection->filterOdd()->toPrimitiveArray(true), true) . "\n\n";

echo "Create an empty DoubleCollection:\n\n";

$doubleCollection = new DoubleCollection();

echo "Calling sum on empty collection will return null:\n\n";

echo var_dump($doubleCollection->sum()) . "\n";

echo "Calling average on empty collection will return null:\n\n";

echo var_dump($doubleCollection->avg()) . "\n";

echo "Calling highest on empty collection will return null:\n\n";

echo var_dump($doubleCollection->highest()) . "\n";

echo "Calling lowest on empty collection will return null:\n\n";

echo var_dump($doubleCollection->lowest());