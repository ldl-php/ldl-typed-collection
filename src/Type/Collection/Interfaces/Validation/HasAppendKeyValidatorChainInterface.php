<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Validation;

use LDL\Validators\Chain\ValidatorChainInterface;

interface HasAppendKeyValidatorChainInterface
{
    /**
     * @return ValidatorChainInterface
     */
    public function getAppendKeyValidatorChain(): ValidatorChainInterface;
}