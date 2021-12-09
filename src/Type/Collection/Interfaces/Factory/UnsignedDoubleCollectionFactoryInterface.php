<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Double\UnsignedDoubleCollection;
use LDL\Type\Collection\Exception\UnsignedDoubleCollectionFactoryException;

interface UnsignedDoubleCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  UnsignedDoubleCollection $collection
     * @throws UnsignedDoubleCollectionFactoryException
     * @return mixed
     */
    public static function fromUnsignedDoubleCollection(UnsignedDoubleCollection $collection);
}