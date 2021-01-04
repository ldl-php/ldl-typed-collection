<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Sorting;

use LDL\Framework\Base\Contracts\PriorityInterface;
use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Sorting\CollectionSortInterface;

trait PrioritySortingTrait
{

    public function sortByPriority(string $sort=CollectionSortInterface::SORT_ASCENDING): CollectionInterface
    {
        /**
         * @var CollectionInterface $this
         */

        $items = \iterator_to_array($this);
        $isAbstractCollection = $this instanceof AbstractCollection;
        $this->truncate();

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

        if($isAbstractCollection){
            $this->disableValidations();
        }

        foreach($items as $key => $value){
            $this->append($value, $key);
        }

        if($isAbstractCollection){
            $this->enableValidations();
        }

        return $this;
    }

}