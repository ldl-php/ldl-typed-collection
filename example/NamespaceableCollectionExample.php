<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Framework\Base\Contracts\NamespaceInterface;
use LDL\Type\Collection\Interfaces\Namespaceable\NamespaceableCollectionInterface;
use LDL\Type\Collection\Types\Object\ObjectCollection;
use LDL\Type\Collection\Traits\Namespaceable\NamespaceableCollectionTrait;

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

class NamespaceableCollectionCollectionExample extends ObjectCollection implements NamespaceableCollectionInterface
{
    use NamespaceableCollectionTrait;
}

echo "Create new Namespaceable collection class instance\n";
$collection = new NamespaceableCollectionCollectionExample();

echo "Append NamespaceClass1\n";
$collection->append(new NamespaceClass1());

echo "Append NamespaceClass2\n";
$collection->append(new NamespaceClass2());

echo "Filter by namespace regex: #.*2$#\n";
echo "Found ".count($collection->filterByNameSpaceRegex('#.*2#'))." elements \n";

echo "Filter by namespace: \"Namespace 1\"\n";
echo "Found ".count($collection->filterByNamespace('Namespace 1'))." elements \n";

echo "Filter by namespaces: [Namespace1, Namespace2]\n";
echo "Found ".count($collection->filterByNamespaces(['Namespace 1', 'Namespace 2']))." elements \n";

echo "Filter by namespace and name: Namespace 1, Name\n";
echo "Found ".count($collection->filterByNamespaceAndName('Namespace 1', 'Name'))." elements \n";