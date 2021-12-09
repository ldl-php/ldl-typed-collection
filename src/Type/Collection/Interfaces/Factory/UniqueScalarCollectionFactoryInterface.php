<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Scalar\UniqueScalarCollection;
use LDL\Type\Collection\Exception\UniqueScalarCollectionFactoryException;

interface UniqueScalarCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  UniqueScalarCollection $collection
     * @throws UniqueScalarCollectionFactoryException
     * @return mixed
     */
    public static function fromUniqueScalarCollection(UniqueScalarCollection $collection);
}