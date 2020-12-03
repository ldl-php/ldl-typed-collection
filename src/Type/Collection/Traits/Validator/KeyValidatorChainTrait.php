<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Validator;

use LDL\Type\Collection\Types\Scalar\Validator\ScalarValidator;
use LDL\Type\Collection\Validator\KeyValidatorChain;
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

        $this->_keyValidator = new KeyValidatorChain();
        $this->_keyValidator->append(new ScalarValidator($strict = true, $acceptToStringObjects = true));

        return $this->_keyValidator;
    }
}