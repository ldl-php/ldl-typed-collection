<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Item\NamedItem;
use LDL\Type\Collection\Traits\Filter\FilterByInterfaceTrait;
use LDL\Type\Collection\Types\Lockable\LockableCollection;


class ObjectCollection extends LockableCollection implements ObjectCollectionInterface
{
    use FilterByInterfaceTrait;

    /**
     * @var array
     */
    private $classData = [];

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getValidatorChain()
            ->append(new Validator\ObjectItemValidator());
    }

    public function append($item, $key = null) : CollectionInterface
    {
        parent::append($item, $key);
        $this->classData[get_class($item)][] = $this->getLastKey();

        return $this;
    }

    public function filterByClass(string $className) : CollectionInterface
    {
        $collection = clone($this);
        $collection->truncate();
        $collection->_validateValues = false;
        $collection->_validateKeys = false;

        if(false === array_key_exists($className, $this->classData)){
            $collection->_validateValues = true;
            $collection->_validateKeys = true;
            return $collection;
        }

        foreach($this->classData[$className] as $offset){
            $collection->append($this[$offset], $offset);
        }

        $collection->_validateValues = true;
        $collection->_validateKeys = true;

        return $collection;
    }

    public function filterByClassRecursive(string $className, ObjectCollectionInterface $objectCollection = null) : CollectionInterface
    {
        if(null === $objectCollection){
            $collection = clone($this);
            $collection->truncate();
        }

        if(null !== $objectCollection){
            $collection = $objectCollection;
        }

        $collection->_validateValues = false;
        $collection->_validateKeys = false;

        $filter = static function($item, $offset) use (&$filter, $collection, $className){
            if(is_object($item) && get_class($item) === $className){
                $collection->append(new NamedItem($offset, $item));
            }

            if($item instanceof \Traversable){
                foreach($item as $o => $i){
                    $filter($i, $o);
                }
            }

            return null;
        };

        foreach($this as $offset => $item){
            $filter($item, $offset);
        }

        $collection->_validateValues = true;
        $collection->_validateKeys = true;

        return $collection;
    }

    public function filterByClasses(array $classes) : CollectionInterface
    {
        $collection = clone($this);
        $collection->truncate();
        $collection->_validateValues = false;
        $collection->_validateKeys = false;

        foreach($this->classData as $className => $indices){
            if(false === in_array($className, $classes, true)){
                continue;
            }

            foreach($indices as $index){
                $collection->append($this[$index], $index);
            }
        }

        $collection->_validateValues = true;
        $collection->_validateKeys = true;

        return $collection;
    }

    public function truncate(): CollectionInterface
    {
        parent::truncate();
        $this->classData = [];

        return $this;
    }

    public function remove($offset): CollectionInterface
    {
        $itemClass = get_class($this->offsetGet($offset));
        parent::remove($offset);
        unset($this->classData[$itemClass][$offset]);

        return $this;
    }

}