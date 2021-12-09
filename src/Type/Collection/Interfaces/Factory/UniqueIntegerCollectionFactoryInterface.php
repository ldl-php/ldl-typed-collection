<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Integer\UniqueIntegerCollection;
use LDL\Type\Collection\Exception\UniqueIntegerCollectionFactoryException;

interface UniqueIntegerCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  UniqueIntegerCollection $collection
     * @throws UniqueIntegerCollectionFactoryException
     * @return mixed
     */
    public static function fromUniqueIntegerCollection(UniqueIntegerCollection $collection);
}