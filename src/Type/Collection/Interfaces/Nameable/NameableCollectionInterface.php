<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Nameable;

use LDL\Type\Collection\TypedCollectionInterface;

interface NameableCollectionInterface
{
    /**
     * Filter a collection by name
     *
     * @param string $name
     * @param TypedCollectionInterface|null $collection
     *
     * @return TypedCollectionInterface
     */
    public function filterByName(string $name, TypedCollectionInterface &$collection=null) : TypedCollectionInterface;

    /**
     * Filters a collection which has NameableInterface items through an array of names
     *
     * @param string[] $names
     * @param TypedCollectionInterface|null $collection
     * @return TypedCollectionInterface
     */
    public function filterByNames(array $names, TypedCollectionInterface &$collection=null) : TypedCollectionInterface;

    /**
     * Filter the collection with a name regex
     *
     * @param string $regex
     * @param TypedCollectionInterface|null $collection
     * @return TypedCollectionInterface
     */
    public function filterByNameRegex(string $regex, TypedCollectionInterface &$collection=null) : TypedCollectionInterface;

    /**
     * Auto determines the $mixed value and applies the appropriate filtering method to filter the collection,
     * use this to avoid multiple if's in your code.
     *
     * @param $mixed
     * @param TypedCollectionInterface|null $collection
     *
     * @return TypedCollectionInterface
     */
    public function filterByNameAuto($mixed, TypedCollectionInterface &$collection=null) : TypedCollectionInterface;

}
