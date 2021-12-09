<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Scalar\ScalarCollection;
use LDL\Type\Collection\Exception\ScalarCollectionFactoryException;

interface ScalarCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  ScalarCollection $collection
     * @throws ScalarCollectionFactoryException
     * @return mixed
     */
    public static function fromScalarCollection(ScalarCollection $collection);
}