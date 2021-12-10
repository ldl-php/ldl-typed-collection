<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Email;

use LDL\Validators\EmailValidator;
use LDL\Type\Collection\Types\String\AbstractStringCollection;
use LDL\Type\Collection\Interfaces\Type\EmailCollectionInterface;

final class EmailCollection extends AbstractStringCollection implements EmailCollectionInterface
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