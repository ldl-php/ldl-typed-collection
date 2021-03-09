<?php declare(strict_types=1);

/**
 * This type of validation is a combined validation, basically it's a collection of different validators
 * which are validated in a chain like fashion.
 *
 * This collection also implements the FilterByInterface interface, which makes it possible to filter the validators
 * appended in this collection.
 */

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Validator\Chain\Traits\ValidatorChainTrait;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;

final class ValueValidatorChain implements ValidatorChainInterface
{
    use ValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        $this->init($items, ValueValidatorInterface::class);
    }

}
