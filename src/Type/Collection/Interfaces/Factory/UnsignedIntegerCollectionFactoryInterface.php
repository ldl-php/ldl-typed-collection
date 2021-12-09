<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Integer\UnsignedIntegerCollection;
use LDL\Type\Collection\Exception\UnsignedIntegerCollectionFactoryException;

interface UnsignedIntegerCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  UnsignedIntegerCollection $collection
     * @throws UnsignedIntegerCollectionFactoryException
     * @return mixed
     */
    public static function fromUnsignedIntegerCollection(UnsignedIntegerCollection $collection);
}