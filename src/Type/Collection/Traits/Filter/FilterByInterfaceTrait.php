<?php declare(strict_types=1);

/**
 * This trait applies the FilterByInterface interface so you can just easily use it in your class.
 *
 * @see \LDL\Type\Collection\Interfaces\Filter\FilterByInterface
 */

namespace LDL\Type\Collection\Traits\Filter;

use LDL\Type\Collection\Interfaces\CollectionInterface;

trait FilterByInterfaceTrait
{

    public function filterByInterface(string $interface) : CollectionInterface
    {
        /**
         * @var CollectionInterface $collection
         */
        $collection = new static();

        foreach($this as $item){
            if($item instanceof $interface){
                $collection->append($item);
            }
        }

        return $collection;
    }

}
