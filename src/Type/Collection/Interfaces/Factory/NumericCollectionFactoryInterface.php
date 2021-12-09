<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Numeric\NumericCollection;
use LDL\Type\Collection\Exception\NumericCollectionFactoryException;

interface NumericCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  NumericCollection $collection
     * @throws NumericCollectionFactoryException
     * @return mixed
     */
    public static function fromNumericCollection(NumericCollection $collection);
}