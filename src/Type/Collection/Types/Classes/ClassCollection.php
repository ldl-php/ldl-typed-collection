<?php declare(strict_types=1);

/**
 * Use this collection when you need to have a series of classes as a string, making sure that
 * the passed class string does indeed exist.
 */

namespace LDL\Type\Collection\Types\Classes;

use LDL\Type\Collection\Types\Lockable\LockableCollection;

class ClassCollection extends LockableCollection
{
    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValueValidatorChain()
            ->append(new Validator\ClassExistenceValidator())
            ->lock();
    }
}