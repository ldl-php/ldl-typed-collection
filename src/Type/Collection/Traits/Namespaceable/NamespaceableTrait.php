<?php declare(strict_types=1);

/**
 * This trait applies Namespaceable trait, make sure to extend your class to the standard ObjectCollection
 * or else make your own implementation of the NamespaceableInterface
 *
 * @see \LDL\Type\Collection\Interfaces\Namespaceable\NamespaceableInterface
 */

namespace LDL\Type\Collection\Traits\Namespaceable;

use LDL\Framework\Base\Contracts\NamespaceInterface;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Helper\RegexValidatorHelper;

trait NamespaceableTrait
{
    public function filterByNamespace(string $namespace) : CollectionInterface
    {
        $collection = new static();

        /**
         * @var NamespaceInterface $value
         */
        foreach($this as $key => $value){
            $equals = $namespace === $value->getNamespace();

            if($equals){
                $collection->append($value, $key);
            }
        }

        if(count($collection) > 0){
            return $collection;
        }

        $msg = sprintf(
            'Could not find items with namespace: "%s"',
            $namespace
        );

        throw new \LogicException($msg);
    }

    public function filterByNamespaceRegex(string $regex) : CollectionInterface
    {
        RegexValidatorHelper::validate($regex);

        $collection = new static();

        /**
         * @var NamespaceInterface $value
         */
        foreach($this as $key => $value){

            if(preg_match($regex, $value->getNamespace())){
                $collection->append($value, $key);
            }
        }

        if(count($collection) > 0){
            return $collection;
        }

        $msg = sprintf(
            'Could not find items using regex: "%s"',
            $regex
        );

        throw new \LogicException($msg);
    }

    public function filterByName(string $name) : CollectionInterface
    {
        $collection = new static();

        /**
         * @var NamespaceInterface $value
         */
        foreach($this as $key => $value){
            $equals = $name === $value->getName();

            if($equals){
                $collection->append($value, $key);
            }
        }

        if(count($collection) > 0){
            return $collection;
        }

        $msg = sprintf(
            'Could not find items with name: "%s"',
            $name
        );

        throw new \LogicException($msg);
    }

    public function filterByNameRegex(string $regex) : CollectionInterface
    {
        RegexValidatorHelper::validate($regex);

        $collection = new static();

        /**
         * @var NamespaceInterface $value
         */
        foreach($this as $key => $value){

            if(preg_match($regex, $value->getName())){
                $collection->append($value, $key);
            }
        }

        if(count($collection) > 0){
            return $collection;
        }

        $msg = sprintf(
            'Could not find items using regex: "%s"',
            $regex
        );

        throw new \LogicException($msg);
    }

    public function filterByNamespaceAndName(string $namespace, string $name)
    {
        /**
         * @var NamespaceInterface $value
         */
        foreach($this as $key => $value){
            $equals = $namespace === $value->getNamespace() && $value->getName() === $name;

            if($equals){
                return $value;
            }
        }

        $msg = sprintf(
            'Could not find item with namespace: "%s" and name "%s"',
            $namespace,
            $name
        );

        throw new \LogicException($msg);
    }

}
