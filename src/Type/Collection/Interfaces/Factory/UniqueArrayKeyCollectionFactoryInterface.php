<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Arrays\UniqueArrayKeyCollection;
use LDL\Type\Collection\Exception\UniqueArrayKeyCollectionFactoryException;

interface UniqueArrayKeyCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  UniqueArrayKeyCollection $collection
     * @throws UniqueArrayKeyCollectionFactoryException
     * @return mixed
     */
    public static function fromUniqueArrayKeyCollection(UniqueArrayKeyCollection $collection);
}