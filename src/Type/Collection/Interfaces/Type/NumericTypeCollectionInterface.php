<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Type;

interface NumericTypeCollectionInterface
{
    /**
     * sum numeric collection
     *
     * @return int|float|null
     */
    public function sum();

    /**
     * get an average of numeric collection
     *
     * @return int|float|null
     */
    public function avg();

    /**
     * get lowest item of numeric collection
     *
     * @return int|float|null
     */
    public function lowest();

    /**
     * get highest item of numeric collection
     *
     * @return int|float|null
     */
    public function highest();

    /**
     * returns numeric collection with even items
     *
     * @return mixed
     */
    public function filterEven(): NumericTypeCollectionInterface;

    /**
     * returns numeric collection with odd items
     *
     * @return mixed
     */
    public function filterOdd(): NumericTypeCollectionInterface;
}
