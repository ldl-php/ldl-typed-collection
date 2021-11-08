<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Email;

use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Types\String\AbstractStringCollection;
use LDL\Validators\EmailValidator;

final class EmailCollection extends AbstractStringCollection implements ToPrimitiveArrayInterface
{

    public function __construct(iterable $items = null)
    {
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->append(new EmailValidator())
            ->lock();

        parent::__construct($items);
    }

}