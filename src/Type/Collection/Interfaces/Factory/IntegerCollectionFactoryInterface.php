<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Integer\IntegerCollection;
use LDL\Type\Collection\Exception\IntegerCollectionFactoryException;

interface IntegerCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  IntegerCollection $collection
     * @throws IntegerCollectionFactoryException
     * @return mixed
     */
    public static function fromIntegerCollection(IntegerCollection $collection);
}