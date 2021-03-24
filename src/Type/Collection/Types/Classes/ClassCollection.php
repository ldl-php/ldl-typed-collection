<?php declare(strict_types=1);

/**
 * Use this collection when you need to have a series of classes as a string, making sure that
 * the passed class string does indeed exist.
 */

namespace LDL\Type\Collection\Types\Classes;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendValidatorChainTrait;
use LDL\Validators\ClassExistenceValidator;

class ClassCollection extends AbstractCollection implements HasAppendValidatorChainInterface
{
    use AppendValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendValidatorChain()
            ->append(new ClassExistenceValidator())
            ->lock();
    }
}