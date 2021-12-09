<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Classes\ClassCollection;
use LDL\Type\Collection\Exception\ClassCollectionFactoryException;

interface ClassCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  ClassCollection $collection
     * @throws ClassCollectionFactoryException
     * @return mixed
     */
    public static function fromClassCollection(ClassCollection $collection);
}