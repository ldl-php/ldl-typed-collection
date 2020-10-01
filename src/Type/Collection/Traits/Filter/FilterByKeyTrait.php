<?php declare(strict_types=1);

/**
 * This trait applies the FilterByKeyInterface so you can just easily use it in your class.
 *
 * @see \LDL\Type\Collection\Interfaces\Filter\FilterByKeyInterface
 */

namespace LDL\Type\Collection\Traits\Locking;

use LDL\Type\Collection\Exception\CollectionKeyException;
use LDL\Type\Collection\Interfaces\CollectionInterface;

trait FilterByKeyTrait
{

    public function filterByKey($filter): CollectionInterface
    {
        if(!is_int($filter) && !is_string($filter)){
            $msg = sprintf(
                'Filter by key takes an integer or a string, "%s" was given',
                gettype($filter)
            );

            throw new CollectionKeyException($msg);
        }

        $collection = new static();

        foreach($this as $key=>$value){
            if($key === $filter){
                $collection->append($value, $key);
            }
        }

        if(count($collection) === 0){
            $msg = "No items could be found by key matching key value: $filter";
            throw new \LogicException($msg);
        }

        return $collection;
    }

    public function filterByKeyRegex(string $regex) : CollectionInterface
    {
        $regex = preg_quote($regex, '#');

        $collection = new static();

        foreach($this as $key=>$value){
            if(preg_match($key, $regex)){
                $collection->append($value, $key);
            }
        }

        if(count($collection) === 0){
            $msg = "No items could be found by key matching regex: $regex";
            throw new \LogicException($msg);
        }

        return $collection;
    }

}
