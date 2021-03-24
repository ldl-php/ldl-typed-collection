<?php declare(strict_types=1);

namespace LDL\Type\Collection\Item;

use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Type\Collection\Types\Object\ObjectCollection;
use LDL\Type\Collection\Types\Object\Validator\InterfaceComplianceItemValidator;

class NamedItemCollection extends ObjectCollection implements NamedItemCollectionInterface
{
    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValidatorChain()
            ->append(new InterfaceComplianceItemValidator(NamedItemInterface::class))
            ->lock();
    }

    public function append($item, $key = null): TypedCollectionInterface
    {
        return parent::append(new NamedItem($key, $item), null);
    }

    public function getItemKeyCount($key) : int
    {
        if(false === is_scalar($key)){
            $msg = sprintf(
                '"%s": "key" is expects to be an scalar value, "%s" was given',
                __CLASS__,
                gettype($key)
            );

            throw new \InvalidArgumentException($msg);
        }

        $count = 0;

        /**
         * @var NamedItem $item
         */
        foreach($this as $item){
            if($item->getName() !== $key){
                continue;
            }

            $count++;
        }

        return $count;
    }

    public function getItemKeyStats(): array
    {
        $return = [];

        /**
         * @var NamedItem $item
         */
        foreach($this as $item){
            $return[] = $item->getName();
        }

        return $return;
    }
}