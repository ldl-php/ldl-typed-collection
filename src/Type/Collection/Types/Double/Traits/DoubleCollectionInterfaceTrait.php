<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Double\Traits;

use LDL\Type\Collection\Interfaces\Type\DoubleCollectionInterface;
use LDL\Type\Collection\Traits\Types\NumericTypeCollectionInterfaceTrait;

trait DoubleCollectionInterfaceTrait
{
    use NumericTypeCollectionInterfaceTrait {
        sum as private _sum;
        avg as private _avg;
        highest as private _highest;
        lowest as private _lowest;
        filterEven as private _filterEven;
        filterOdd as private _filterOdd;
    }

    /**
     * sum double collection
     *
     * @return float|null
     */
    public function sum(): ?float
    {
        return $this->_sum();
    }

    /**
     * get an average of double collection
     *
     * @return float|null
     */
    public function avg(): ?float
    {
        return $this->_avg();
    }

    /**
     * get lowest item of double collection
     *
     * @return float|null
     */
    public function lowest(): ?float
    {
        return $this->_lowest();
    }

    /**
     * get highest item of double collection
     *
     * @return float|null
     */
    public function highest(): ?float
    {
        return $this->_highest();
    }

    /**
     * returns double collection with even items
     *
     * @return DoubleCollectionInterface
     */
    public function filterEven(): DoubleCollectionInterface
    {
        return $this->_filterEven();
    }

    /**
     * returns double collection with odd items
     *
     * @return DoubleCollectionInterface
     */
    public function filterOdd(): DoubleCollectionInterface
    {
        return $this->_filterOdd();
    }
}