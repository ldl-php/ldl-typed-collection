<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Validator;

use LDL\Type\Collection\Validator\ValidatorChain;
use LDL\Type\Collection\Validator\ValidatorChainInterface;

trait KeyValidatorChainTrait
{
    /**
     * @var ValidatorChainInterface
     */
    private $_keyValidator;

    public function getKeyValidatorChain(): ValidatorChainInterface
    {
        if(null !== $this->_keyValidator){
            return $this->_keyValidator;
        }

        $this->_keyValidator = new ValidatorChain();

        return $this->_keyValidator;
    }
}