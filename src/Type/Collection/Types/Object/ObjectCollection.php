<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object;

use LDL\Type\Collection\Interfaces;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Filter\FilterByClassInterface;
use LDL\Type\Collection\Traits\Filter\FilterByInterfaceTrait;
use LDL\Type\Collection\Types\Lockable\LockableCollection;
use LDL\Type\Collection\Types\Object\Filter\FilterByInterface;

class ObjectCollection extends LockableCollection implements FilterByInterface, FilterByClassInterface
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

    public function remove($offset): Interfaces\CollectionInterface
    {
        $itemClass = get_class($this->offsetGet($offset));
        parent::remove($offset);
        unset($this->classData[$itemClass][$offset]);

        return $this;
    }

}