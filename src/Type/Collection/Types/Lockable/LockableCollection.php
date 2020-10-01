<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Lockable;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Locking\LockableCollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\HasValidatorChainInterface;
use LDL\Type\Collection\Traits\Locking\LockedCollectionTrait;
use LDL\Type\Collection\Validator\ValidatorChain;
use LDL\Type\Collection\Validator\ValidatorChainInterface;

class LockableCollection extends AbstractCollection implements HasValidatorChainInterface, LockableCollectionInterface
{
    use LockedCollectionTrait;

    /**
     * @var ValidatorChain
     */
    private $validatorChain;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->validatorChain = new ValidatorChain();
        $this->validatorChain->append(new Validator\LockingValidator());
    }

    public function getValidatorChain(): ValidatorChainInterface
    {
        return $this->validatorChain;
    }
}