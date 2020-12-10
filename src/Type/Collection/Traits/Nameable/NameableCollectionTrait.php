<?php declare(strict_types=1);

/**
 * This trait applies NameableCollectionInterface as a trait, make sure your collection implements NameableCollectionInterface
 *
 * @see \LDL\Type\Collection\Interfaces\Nameable\NameableCollectionInterface
 */

namespace LDL\Type\Collection\Traits\Nameable;

use LDL\Framework\Base\Contracts\NameableInterface;
use LDL\Framework\Base\Contracts\NamespaceInterface;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Helper\RegexValidatorHelper;

trait NameableCollectionTrait
{
    public function filterByName(string $name, CollectionInterface &$collection=null) : CollectionInterface
    {
        return $this->filterByNames([$name], $collection);
    }

    public function filterByNames(array $names, CollectionInterface &$collection=null) : CollectionInterface
    {
        if(null === $collection) {
            $collection = clone($this);
            $collection->truncate();
        }

        /**
         * @var NameableInterface $value
         */
        foreach($this as $key => $value){
            if(in_array($value->getName(), $names, true)){
                $collection->append($value, $key);
            }
        }

        return $collection;
    }

    public function filterByNameRegex(string $regex, CollectionInterface &$collection=null) : CollectionInterface
    {
        RegexValidatorHelper::validate($regex);

        if(null === $collection) {
            $collection = clone($this);
            $collection->truncate();
        }

        /**
         * @var NamespaceInterface $value
         */
        foreach($this as $key => $value){
            if(preg_match($regex, $value->getName())){
                $collection->append($value, $key);
            }
        }

        return $collection;
    }

}
