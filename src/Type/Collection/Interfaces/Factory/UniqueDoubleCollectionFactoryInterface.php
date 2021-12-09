<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Double\UniqueDoubleCollection;
use LDL\Type\Collection\Exception\UniqueDoubleCollectionFactoryException;

interface UniqueDoubleCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  UniqueDoubleCollection $collection
     * @throws UniqueDoubleCollectionFactoryException
     * @return mixed
     */
    public static function fromUniqueDoubleCollection(UniqueDoubleCollection $collection);
}