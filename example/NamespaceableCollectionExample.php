<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Framework\Base\Contracts\NamespaceInterface;
use LDL\Type\Collection\Interfaces\Namespaceable\NamespaceableInterface;
use LDL\Type\Collection\Types\Object\ObjectCollection;
use LDL\Type\Collection\Traits\Namespaceable\NamespaceableTrait;

class NamespaceClass1 implements NamespaceInterface
{
    public function getNamespace(): string
    {
        return 'Namespace 1';
    }

    public function getName(): string
    {
        return 'Name';
    }
}

class NamespaceClass2 implements NamespaceInterface
{
    public function getNamespace(): string
    {
        return 'Namespace 2';
    }

    public function getName(): string
    {
        return 'Name';
    }
}

class NamespaceableCollectionExample extends ObjectCollection implements NamespaceableInterface
{
    use NamespaceableTrait;
}

echo "Create new Namespaceable collection class instance\n";
$collection = new NamespaceableCollectionExample();

echo "Append NamespaceClass1\n";
$collection->append(new NamespaceClass1());

echo "Append NamespaceClass2\n";
$collection->append(new NamespaceClass2());

echo "Filter by name: Name\n";
echo "Found ".count($collection->filterByName('Name'))." elements \n";

echo "Filter by namespace regex: #.*2$#\n";
echo "Found ".count($collection->filterByNameSpaceRegex('#.*2$#'))." elements \n";

echo "Filter by namespace regex: #^N.*#\n";
echo "Found ".count($collection->filterByNameRegex('#^N.*#'))." elements \n";