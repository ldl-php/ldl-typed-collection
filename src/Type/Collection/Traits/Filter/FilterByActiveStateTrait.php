<?php declare(strict_types=1);

/**
 * This trait applies the FilterByActiveStateInterface so you can just easily use it in your class.
 * Don't forget to validate the items in your collection against IsActiveInterface
 *
 * @see \LDL\Framework\Base\Contracts\IsActiveInterface
 * @see \LDL\Type\Collection\Interfaces\Filter\FilterByActiveStateInterface
 */

namespace LDL\Type\Collection\Traits\Filter;

use LDL\Framework\Base\Contracts\IsActiveInterface;
use LDL\Type\Collection\Interfaces\CollectionInterface;

trait FilterByActiveStateTrait
{
    public function filterByActiveState(): CollectionInterface
    {
        $collection = new static();

        /**
         * @var IsActiveInterface $item
         */
        foreach($this as $key=>$item){
            if($item->isActive()){
                $collection->append($item, $key);
            }
        }

        return $collection;
    }
}
