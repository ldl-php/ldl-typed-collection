<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Filter;

use LDL\Type\Collection\Exception\EmptyCollectionException;
use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\String\StringCollection;

interface FilterValueTypeInterface
{
    /**
     * Filters a mixed collection by type value
     *
     * @see \gettype
     * @param string $value
     * @throws EmptyCollectionException
     * @return TypedCollectionInterface
     */
    public function filterByValueType(string $value) : TypedCollectionInterface;

    /**
     * Filters a mixed collection against several types
     *
     * @see \gettype
     * @param StringCollection $types
     * @throws EmptyCollectionException
     * @return TypedCollectionInterface
     */
    public function filterByValueTypes(StringCollection $types): TypedCollectionInterface;

}