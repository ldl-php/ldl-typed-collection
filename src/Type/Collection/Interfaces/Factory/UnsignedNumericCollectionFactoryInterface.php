<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Numeric\UnsignedNumericCollection;
use LDL\Type\Collection\Exception\UnsignedNumericCollectionFactoryException;

interface UnsignedNumericCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  UnsignedNumericCollection $collection
     * @throws UnsignedNumericCollectionFactoryException
     * @return mixed
     */
    public static function fromUnsignedNumericCollection(UnsignedNumericCollection $collection);
}