<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Validator;

use LDL\Type\Collection\Validator\ValueValidatorChain;
use LDL\Type\Collection\Validator\ValidatorChainInterface;

trait ValueValidatorChainTrait
{
    /**
     * @var ValidatorChainInterface
     */
    private $_validatorChain;

    public function getValueValidatorChain(): ValidatorChainInterface
    {
        if(null !== $this->_validatorChain){
            return $this->_validatorChain;
        }

        $this->_validatorChain = new ValueValidatorChain();
        return $this->_validatorChain;
    }
}