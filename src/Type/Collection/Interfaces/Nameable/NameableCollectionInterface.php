<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Nameable;

use LDL\Type\Collection\Interfaces\CollectionInterface;

interface NameableCollectionInterface
{
    /**
     * Filter a collection by name
     *
     * @param string $name
     * @param CollectionInterface|null $collection
     *
     * @return CollectionInterface
     */
    public function filterByName(string $name, CollectionInterface &$collection=null) : CollectionInterface;

    /**
     * Filters a collection which has NameableInterface items through an array of names
     *
     * @param string[] $names
     * @param CollectionInterface|null $collection
     * @return CollectionInterface
     */
    public function filterByNames(array $names, CollectionInterface &$collection=null) : CollectionInterface;

    /**
     * Filter the collection with a name regex
     *
     * @param string $regex
     * @param CollectionInterface|null $collection
     * @return CollectionInterface
     */
    public function filterByNameRegex(string $regex, CollectionInterface &$collection=null) : CollectionInterface;

}
