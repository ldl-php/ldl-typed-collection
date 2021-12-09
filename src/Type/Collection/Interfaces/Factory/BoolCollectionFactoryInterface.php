<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Bool\BoolCollection;
use LDL\Type\Collection\Exception\BoolCollectionFactoryException;

interface BoolCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  BoolCollection $collection
     * @throws BoolCollectionFactoryException
     * @return mixed
     */
    public static function fromBoolCollection(BoolCollection $collection);
}