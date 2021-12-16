<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Integer\Traits;

use LDL\Type\Collection\Interfaces\Type\IntegerCollectionInterface;
use LDL\Type\Collection\Traits\Types\NumericTypeCollectionInterfaceTrait;

trait IntegerCollectionInterfaceTrait
{
    use NumericTypeCollectionInterfaceTrait {
        sum as private _sum;
        avg as private _avg;
        lowest as private _lowest;
        highest as private _highest;
        filterEven as private _filterEven;
        filterOdd as private _filterOdd;
    }

    /**
     * sum int collection
     *
     * @return int|null
     */
    public function sum(): ?int
    {
        return $this->_sum();
    }

    /**
     * get an average of int collection
     *
     * @return int|null
     */
    public function avg(): ?int
    {
        return (int) $this->_avg();
    }

    /**
     * get lowest item of int collection
     *
     * @return int|null
     */
    public function lowest(): ?int
    {
        return $this->_lowest();
    }

    /**
     * get highest item of int collection
     *
     * @return int|null
     */
    public function highest(): ?int
    {
        return $this->_highest();
    }

    /**
     * returns int collection with even items
     *
     * @return IntegerCollectionInterface
     */
    public function filterEven(): IntegerCollectionInterface
    {
        return $this->_filterEven();
    }

    /**
     * returns int collection with odd items
     *
     * @return IntegerCollectionInterface
     */
    public function filterOdd(): IntegerCollectionInterface
    {
        return $this->_filterOdd();
    }
}
