<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Double\DoubleCollection;
use LDL\Type\Collection\Exception\DoubleCollectionFactoryException;

interface DoubleCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  DoubleCollection $collection
     * @throws DoubleCollectionFactoryException
     * @return mixed
     */
    public static function fromDoubleCollection(DoubleCollection $collection);
}