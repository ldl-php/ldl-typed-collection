<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Filter;

use LDL\Type\Collection\Interfaces\CollectionInterface;

interface FilterByKeyInterface
{
    /**
     * Filters a collection by key
     *
     * @param number|string $key
     *
     * @return CollectionInterface
     */
    public function filterByKey($key) : CollectionInterface;

    /**
     * Filter the collection with a regex matching keys of items
     *
     * @param string $regex
     * @return mixed
     */
    public function filterByKeyRegex(string $regex) : CollectionInterface;
}