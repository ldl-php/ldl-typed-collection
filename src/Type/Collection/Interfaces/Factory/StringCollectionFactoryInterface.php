<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\String\StringCollection;
use LDL\Type\Collection\Exception\StringCollectionFactoryException;

interface StringCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  StringCollection $collection
     * @throws StringCollectionFactoryException
     * @return mixed
     */
    public static function fromStringCollection(StringCollection $collection);
}