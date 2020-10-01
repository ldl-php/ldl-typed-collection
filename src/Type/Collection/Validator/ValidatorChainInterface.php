<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Locking\LockableCollectionInterface;

interface ValidatorChainInterface extends CollectionInterface, LockableCollectionInterface
{
    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @return void
     */
    public function validate(CollectionInterface $collection, $item, $key) : void;
}