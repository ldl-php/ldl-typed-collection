<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Validation;

use LDL\Validators\Chain\ValidatorChainInterface;

interface HasRemoveValidatorChainInterface
{
    /**
     * @return ValidatorChainInterface
     */
    public function getRemoveValidatorChain(): ValidatorChainInterface;
}