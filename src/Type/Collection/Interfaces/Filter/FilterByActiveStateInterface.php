<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Filter;

use LDL\Framework\Base\Contracts\IsActiveInterface;
use LDL\Type\Collection\Interfaces\CollectionInterface;

interface FilterByActiveStateInterface
{
    /**
     * Filters a collection by items which are active
     *
     * @see IsActiveInterface
     *
     * @return CollectionInterface
     */
    public function filterByActiveState() : CollectionInterface;
}