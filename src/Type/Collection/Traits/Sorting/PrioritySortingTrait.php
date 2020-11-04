<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Sorting;

use LDL\Framework\Base\Contracts\PriorityInterface;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Sorting\CollectionSortInterface;

trait PrioritySortingTrait
{

    public function sortByPriority(string $sort=CollectionSortInterface::SORT_ASCENDING): CollectionInterface
    {
        /**
         * @var CollectionInterface $_this
         */
        $_this = clone($this);
        $this->truncate();

        $items = \iterator_to_array($_this);

        uasort(
            $items,
            /**
             * @param PriorityInterface $a
             * @param PriorityInterface $b
             * @return int
             */
            static function ($a, $b) use ($sort) {
                $priorityA = $a->getPriority();
                $priorityB = $b->getPriority();

                return 'asc' === $sort ? $priorityA <=> $priorityB : $priorityB <=> $priorityA;
            }
        );

        foreach($items as $key=>$value){
            $this->append($value, $key);
        }

        return $this;
    }

}