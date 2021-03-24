<?php declare(strict_types=1);

/**
 * This trait applies NameableCollectionInterface as a trait, make sure your collection implements NameableCollectionInterface
 *
 * @see \LDL\Type\Collection\Interfaces\Nameable\NameableCollectionInterface
 */

namespace LDL\Type\Collection\Traits\Nameable;

use LDL\Framework\Base\Contracts\NameableInterface;
use LDL\Framework\Helper\RegexHelper;
use LDL\Type\Collection\TypedCollectionInterface;

trait NameableCollectionTrait
{
    public function filterByNameAuto($mixed, TypedCollectionInterface &$collection=null) : TypedCollectionInterface
    {
        if(is_array($mixed)){
            return $this->filterByNames($mixed, $collection);
        }

        try {
            return $this->filterByNameRegex($mixed, $collection);
        }catch(\LogicException $e) {
            return $this->filterByNames([$mixed], $collection);
        }
    }

    public function filterByName(string $name, TypedCollectionInterface &$collection=null) : TypedCollectionInterface
    {
        return $this->filterByNames([$name], $collection);
    }

    public function filterByNames(array $names, TypedCollectionInterface &$collection=null) : TypedCollectionInterface
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

    public function filterByNameRegex(string $regex, TypedCollectionInterface &$collection=null) : TypedCollectionInterface
    {
        RegexHelper::validate($regex);

        if(null === $collection) {
            $collection = clone($this);
            $collection->truncate();
        }

        /**
         * @var NameableInterface $value
         */
        foreach($this as $key => $value){
            if(preg_match($regex, $value->getName())){
                $collection->append($value, $key);
            }
        }

        return $collection;
    }

}
