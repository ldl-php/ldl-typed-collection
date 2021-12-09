<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Object\ObjectCollection;
use LDL\Type\Collection\Exception\ObjectCollectionFactoryException;

interface ObjectCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  ObjectCollection $collection
     * @throws ObjectCollectionFactoryException
     * @return mixed
     */
    public static function fromObjectCollection(ObjectCollection $collection);
}