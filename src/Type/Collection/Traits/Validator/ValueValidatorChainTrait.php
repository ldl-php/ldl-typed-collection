<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Validator;

use LDL\Type\Collection\Validator\ValidatorChain;
use LDL\Type\Collection\Validator\ValidatorChainInterface;

trait ValueValidatorChainTrait
{
    /**
     * @var ValidatorChainInterface
     */
    private $_validatorChain;

    public function getValidatorChain(): ValidatorChainInterface
    {
        if(null !== $this->_validatorChain){
            return $this->_validatorChain;
        }

        $this->_validatorChain = new ValidatorChain();
        return $this->_validatorChain;
    }
}