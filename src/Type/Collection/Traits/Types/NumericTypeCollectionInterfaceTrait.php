<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Types;

trait NumericTypeCollectionInterfaceTrait
{
    /**
     * sum numeric collection
     *
     * @return int|float|null
     */
    public function sum()
    {
        if (!$this->count()) {
            return null;
        }

        return array_sum(
            $this->toPrimitiveArray(true)
        );
    }

    /**
     * get an average of numeric collection
     *
     * @return int|float|null
     */
    public function avg()
    {
        $count = $this->count();

        return $count ? $this->sum() / $count : null;
    }

    /**
     * get lowest item of numeric collection
     *
     * @return int|float|null
     */
    public function lowest()
    {
        if (!$this->count()) {
            return null;
        }

        return min(
            $this->toPrimitiveArray(true)
        );
    }

    /**
     * get highest item of numeric collection
     *
     * @return int|float|null
     */
    public function highest()
    {
        if (!$this->count()) {
            return null;
        }
        
        return max(
            $this->toPrimitiveArray(true)
        );
    }

    /**
     * returns numeric collection with even items
     *
     * @return mixed
     */
    public function filterEven()
    {
        return $this->filter(function ($item) {
            return is_numeric($item) && $item % 2 === 0;
        });
    }

    /**
     * returns numeric collection with odd items
     *
     * @return mixed
     */
    public function filterOdd()
    {
        return $this->filter(function ($item) {
            return is_numeric($item) && $item % 2 !== 0;
        });
    }
}
