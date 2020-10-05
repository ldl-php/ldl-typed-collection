<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Locking\LockableCollectionInterface;
use LDL\Type\Collection\Types\Object\Filter\FilterByInterface;

interface ValidatorChainInterface extends CollectionInterface, LockableCollectionInterface, FilterByInterface
{
    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     *
     * @throws \Exception
     *
     * @return void
     */
    public function validate(CollectionInterface $collection, $item, $key) : void;
}