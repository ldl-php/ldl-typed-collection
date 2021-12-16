<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Numeric\Traits;

use LDL\Type\Collection\Interfaces\Type\NumericCollectionInterface;
use LDL\Type\Collection\Traits\Types\NumericTypeCollectionInterfaceTrait;

trait NumericCollectionInterfaceTrait
{
    use NumericTypeCollectionInterfaceTrait {
        filterEven as private _filterEven;
        filterOdd as private _filterOdd;
    }

    /**
     * returns int collection with even items
     *
     * @return NumericCollectionInterface
     */
    public function filterEven(): NumericCollectionInterface
    {
        return $this->_filterEven();
    }

    /**
     * returns int collection with odd items
     *
     * @return NumericCollectionInterface
     */
    public function filterOdd(): NumericCollectionInterface
    {
        return $this->_filterOdd();
    }
}