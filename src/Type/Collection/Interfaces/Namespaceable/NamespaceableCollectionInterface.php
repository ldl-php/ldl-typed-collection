<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Namespaceable;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Nameable\NameableCollectionInterface;

interface NamespaceableCollectionInterface extends NameableCollectionInterface
{
    /**
     * Filter a collection by namespace
     *
     * @param string $namespace
     * @param CollectionInterface|null $collection
     *
     * @return CollectionInterface
     */
    public function filterByNamespace(string $namespace, CollectionInterface &$collection=null) : CollectionInterface;

    /**
     * Filter a collection by multiple namespaces
     *
     * @param string[] $namespaces
     * @param CollectionInterface|null $collection
     * @return CollectionInterface
     */
    public function filterByNamespaces(array $namespaces, CollectionInterface &$collection=null) : CollectionInterface;

    /**
     * Filter the collection with a namespace regex
     *
     * @param string $regex
     * @param CollectionInterface|null $collection
     * @return CollectionInterface
     */
    public function filterByNamespaceRegex(string $regex, CollectionInterface &$collection=null) : CollectionInterface;

    /**
     * Filter a collection with elements that match a given namespace and name combination
     *
     * @param string $namespace
     * @param string $name
     * @param CollectionInterface $collection
     * @return CollectionInterface
     */
    public function filterByNamespaceAndName(
        string $namespace,
        string $name,
        CollectionInterface &$collection=null
    ) : CollectionInterface;
}
