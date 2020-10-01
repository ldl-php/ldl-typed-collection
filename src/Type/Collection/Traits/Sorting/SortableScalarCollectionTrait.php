<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Sorting;

use LDL\Framework\Base\Contracts\PriorityInterface;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Sorting\CollectionSortInterface;
use LDL\Type\Collection\Interfaces\Sorting\SortableScalarCollectionInterface;

trait SortableScalarCollectionTrait
{

    public function sort(string $sort = CollectionSortInterface::SORT_ASCENDING): CollectionInterface
    {
        /**
         * @var CollectionInterface $_this
         */
        $_this = $this;

        /**
         * @var CollectionInterface $collection
         */
        $collection = new static();

        $items = \iterator_to_array($_this);

        usort(
            $items,
            /**
             * @param PriorityInterface $a
             * @param PriorityInterface $b
             * @return int
             */
            static function ($a, $b) use ($sort) {

                if(!is_scalar($a) || !is_scalar($b)){
                    $msg = sprintf(
                        'If you want to implement "%s" in your collection, then it must be composed ONLY of scalar values',
                        SortableScalarCollectionInterface::class
                    );

                    throw new \InvalidArgumentException($msg);
                }

                return 'asc' === $sort ? $a <=> $b : $b <=> $a;
            }
        );

        foreach($items as $key=>$value){
            $collection->append($key, $value);
        }

        return $collection;
    }

}