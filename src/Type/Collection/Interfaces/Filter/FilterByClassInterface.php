<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Filter;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Types\Object\ObjectCollectionInterface;

interface FilterByClassInterface
{
    /**
     * @param string $className
     * @return CollectionInterface
     */
    public function filterByClass(string $className) : CollectionInterface;

    /**
     * @param string $className
     * @param ObjectCollectionInterface|null $objectCollection
     * @return CollectionInterface
     */
    public function filterByClassRecursive(
        string $className,
        ObjectCollectionInterface $objectCollection = null
    ) : CollectionInterface;

    /**
     * @param array $classes
     * @return mixed
     */
    public function filterByClasses(array $classes) : CollectionInterface;
}