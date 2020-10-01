<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Filter;

use LDL\Type\Collection\Interfaces\CollectionInterface;

interface FilterByStringValueInterface
{
    /**
     * Filters a collection by string value
     *
     * @param string $value
     *
     * @return CollectionInterface
     */
    public function filterByStringValue(string $value) : CollectionInterface;

    /**
     * Filter the collection with a regex matching values of items
     *
     * @param string $regex
     * @return mixed
     */
    public function filterByKeyRegex(string $regex) : CollectionInterface;
}