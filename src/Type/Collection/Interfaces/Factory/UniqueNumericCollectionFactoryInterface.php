<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Numeric\UniqueNumericCollection;
use LDL\Type\Collection\Exception\UniqueNumericCollectionFactoryException;

interface UniqueNumericCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  UniqueNumericCollection $collection
     * @throws UniqueNumericCollectionFactoryException
     * @return mixed
     */
    public static function fromUniqueNumericCollection(UniqueNumericCollection $collection);
}