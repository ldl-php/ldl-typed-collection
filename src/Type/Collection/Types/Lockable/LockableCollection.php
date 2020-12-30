<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Lockable;

use LDL\Framework\Base\Contracts\LockableObjectInterface;
use LDL\Framework\Base\Traits\LockableObjectInterfaceTrait;
use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Validator\ValueValidatorChain;

class LockableCollection extends AbstractCollection implements HasValueValidatorChainInterface, LockableObjectInterface
{
    use LockableObjectInterfaceTrait;
    use ValueValidatorChainTrait;

    /**
     * @var ValueValidatorChain
     */
    private $validatorChain;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValueValidatorChain()
            ->append(new Validator\LockingValidator());
    }

}