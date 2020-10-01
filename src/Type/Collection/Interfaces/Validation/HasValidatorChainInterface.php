<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Validation;

use LDL\Type\Collection\Validator\ValidatorChainInterface;

interface HasValidatorChainInterface
{
    public function getValidatorChain() : ValidatorChainInterface;
}