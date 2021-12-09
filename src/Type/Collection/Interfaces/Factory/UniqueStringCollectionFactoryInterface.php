<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\String\UniqueStringCollection;
use LDL\Type\Collection\Exception\UniqueStringCollectionFactoryException;

interface UniqueStringCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  UniqueStringCollection $collection
     * @throws UniqueStringCollectionFactoryException
     * @return mixed
     */
    public static function fromUniqueStringCollection(UniqueStringCollection $collection);
}