<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Namespaceable;

use LDL\Type\Collection\Interfaces\CollectionInterface;

interface NamespaceableInterface
{
    /**
     * Filter a collection by namespace
     *
     * @param string $namespace
     * @throws \LogicException if no items could be found matching the criteria
     * @return CollectionInterface
     */
    public function filterByNamespace(string $namespace) : CollectionInterface;

    /**
     * Filter the collection with a namespace regex
     *
     * @param string $regex
     * @throws \LogicException if no items could be found matching the criteria
     * @return CollectionInterface
     */
    public function filterByNamespaceRegex(string $regex) : CollectionInterface;

    /**
     * Filter a collection by name
     *
     * @param string $name
     * @throws \LogicException if no items could be found matching the criteria
     * @return CollectionInterface
     */
    public function filterByName(string $name) : CollectionInterface;

    /**
     * Filter the collection with a name regex
     *
     * @param string $regex
     * @throws \LogicException if no items could be found matching the criteria
     * @return CollectionInterface
     */
    public function filterByNameRegex(string $regex) : CollectionInterface;

    /**
     * Filter a collection by namespace and name (only one item must be returned)
     *
     * @param string $namespace
     * @param string $name
     *
     * @return mixed
     */
    public function filterByNamespaceAndName(string $namespace, string $name);
}
