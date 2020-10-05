<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object\Filter;

use LDL\Type\Collection\Interfaces\CollectionInterface;

interface FilterByInterface
{

    /**
     * Filters objects inside an object collection by interface
     *
     * @param string $interface
     * @return CollectionInterface
     */
    public function filterByInterface(string $interface) : CollectionInterface;

}