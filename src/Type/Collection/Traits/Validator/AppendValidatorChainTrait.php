<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Validator;

use LDL\Validators\Chain\ValidatorChain;
use LDL\Validators\Chain\ValidatorChainInterface;

trait AppendValidatorChainTrait
{
    /**
     * @var ValidatorChainInterface
     */
    private $_tAppendValidatorChain;

    public function getAppendValidatorChain(): ValidatorChainInterface
    {
        if(null !== $this->_tAppendValidatorChain){
            return $this->_tAppendValidatorChain;
        }

        $this->_tAppendValidatorChain = new ValidatorChain();

        $this->getBeforeAppend()->append(function($collection, $item, $key){
            $this->_tAppendValidatorChain->validate($item, $key, $collection);
        });

        return $this->_tAppendValidatorChain;
    }
}