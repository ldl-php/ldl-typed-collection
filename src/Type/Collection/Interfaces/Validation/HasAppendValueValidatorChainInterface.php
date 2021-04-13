<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Validation;

use LDL\Validators\Chain\ValidatorChainInterface;

interface HasAppendValueValidatorChainInterface
{
    /**
     * @return ValidatorChainInterface
     */
    public function getAppendValueValidatorChain(): ValidatorChainInterface;
}