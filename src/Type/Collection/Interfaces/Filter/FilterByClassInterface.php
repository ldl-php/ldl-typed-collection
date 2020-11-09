<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Filter;

use LDL\Type\Collection\Interfaces\CollectionInterface;

interface FilterByClassInterface
{
    /**
     * @param string $className
     * @return CollectionInterface
     */
    public function filterByClass(string $className) : CollectionInterface;

    /**
     * @param array $classes
     * @return mixed
     */
    public function filterByClasses(array $classes) : CollectionInterface;
}