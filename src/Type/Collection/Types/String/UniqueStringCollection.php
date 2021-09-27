<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\String;

use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Validators\StringValidator;

final class UniqueStringCollection extends AbstractStringCollection implements ToPrimitiveArrayInterface
{
    use AppendValueValidatorChainTrait;

    /**
     * @var string|null
     */
    private $imploded;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->appendMany([
                    new StringValidator(),
                    new UniqueValidator()
            ])
            ->lock();
    }

}