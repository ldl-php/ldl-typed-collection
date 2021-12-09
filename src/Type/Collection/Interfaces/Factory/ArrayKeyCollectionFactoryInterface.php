<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Arrays\ArrayKeyCollection;
use LDL\Type\Collection\Exception\ArrayKeyCollectionFactoryException;

interface ArrayKeyCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  ArrayKeyCollection $collection
     * @throws ArrayKeyCollectionFactoryException
     * @return mixed
     */
    public static function fromArrayKeyCollection(ArrayKeyCollection $collection);
}