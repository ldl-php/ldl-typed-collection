<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Namespaceable;

use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Interfaces\Nameable\NameableCollectionInterface;

interface NamespaceableCollectionInterface extends NameableCollectionInterface
{
    /**
     * Filter a collection by namespace
     *
     * @param string $namespace
     * @param TypedCollectionInterface|null $collection
     *
     * @return TypedCollectionInterface
     */
    public function filterByNamespace(string $namespace, TypedCollectionInterface &$collection=null) : TypedCollectionInterface;

    /**
     * Filter a collection by multiple namespaces
     *
     * @param string[] $namespaces
     * @param TypedCollectionInterface|null $collection
     * @return TypedCollectionInterface
     */
    public function filterByNamespaces(array $namespaces, TypedCollectionInterface &$collection=null) : TypedCollectionInterface;

    /**
     * Filter the collection with a namespace regex
     *
     * @param string $regex
     * @param TypedCollectionInterface|null $collection
     * @return TypedCollectionInterface
     */
    public function filterByNamespaceRegex(string $regex, TypedCollectionInterface &$collection=null) : TypedCollectionInterface;

    /**
     * Filter a collection with elements that match a given namespace and name combination
     *
     * @param string $namespace
     * @param string $name
     * @param TypedCollectionInterface $collection
     * @return TypedCollectionInterface
     */
    public function filterByNamespaceAndName(
        string $namespace,
        string $name,
        TypedCollectionInterface &$collection=null
    ) : TypedCollectionInterface;

    /**
     * Auto determines the $mixed value and applies the appropriate filtering method to filter the collection,
     * use this to avoid multiple if's in your code.
     *
     * @param $mixed
     * @param TypedCollectionInterface|null $collection
     *
     * @return TypedCollectionInterface
     */
    public function filterByNamespaceAuto($mixed, TypedCollectionInterface &$collection=null) : TypedCollectionInterface;
}
