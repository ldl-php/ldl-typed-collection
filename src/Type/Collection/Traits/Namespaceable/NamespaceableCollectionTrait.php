<?php declare(strict_types=1);

/**
 * This trait applies Namespaceable trait, make sure to extend your class to the standard ObjectCollection
 * or else make your own implementation of the NamespaceableInterface
 *
 * @see \LDL\Type\Collection\Interfaces\Namespaceable\NamespaceableCollectionInterface
 */

namespace LDL\Type\Collection\Traits\Namespaceable;

use LDL\Framework\Base\Contracts\NamespaceInterface;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Traits\Nameable\NameableCollectionTrait;
use LDL\Type\Helper\RegexValidatorHelper;

trait NamespaceableCollectionTrait
{
    use NameableCollectionTrait;

    public function filterByNamespaceAuto($mixed, CollectionInterface &$collection=null) : CollectionInterface
    {
        if(is_array($mixed)){
            return $this->filterByNamespaces($mixed, $collection);
        }

        try {
            return $this->filterByNamespaceRegex((string) $mixed, $collection);
        }catch(\LogicException $e) {
            return $this->filterByNamespaces([$mixed], $collection);
        }
    }

    public function filterByNamespaces(array $nameSpaces, CollectionInterface &$collection=null) : CollectionInterface
    {

        if(null === $collection) {
            $collection = clone($this);
            $collection->truncate();
        }

        /**
         * @var NamespaceInterface $value
         */
        foreach($this as $key => $value){
            if(in_array($value->getNamespace(), $nameSpaces, true)){
                $collection->append($value, $key);
            }
        }

        return $collection;
    }

    public function filterByNamespace(string $namespace, CollectionInterface &$collection=null) : CollectionInterface
    {
        return $this->filterByNamespaces([$namespace], $collection);
    }

    public function filterByNamespaceRegex(string $regex, CollectionInterface &$collection=null) : CollectionInterface
    {
        RegexValidatorHelper::validate($regex);

        if(null === $collection) {
            $collection = clone($this);
            $collection->truncate();
        }

        /**
         * @var CollectionInterface $collection
         */
        $collection = clone($this);
        $collection->truncate();

        /**
         * @var NamespaceInterface $value
         */
        foreach($this as $key => $value){
            if(preg_match($regex, $value->getNamespace())){
                $collection->append($value, $key);
            }
        }

        return $collection;
    }

    public function filterByNamespaceAndName(string $namespace, string $name, CollectionInterface &$collection=null) : CollectionInterface
    {
        if(null === $collection) {
            $collection = clone($this);
            $collection->truncate();
        }

        /**
         * @var NamespaceInterface $value
         */
        foreach($this as $key => $value){
            if($namespace === $value->getNamespace() && $value->getName() === $name){
                $collection->append($value);
            }
        }

        return $collection;
    }

}
