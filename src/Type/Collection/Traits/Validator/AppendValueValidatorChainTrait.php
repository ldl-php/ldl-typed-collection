<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Validator;

use LDL\Validators\Chain\ValidatorChain;
use LDL\Validators\Chain\ValidatorChainInterface;

trait AppendValueValidatorChainTrait
{
    /**
     * @var ValidatorChainInterface
     */
    private $_tAppendValueValidatorChain;

    //<editor-fold desc="HasAppendValueValidatorChainInterface methods">
    public function getAppendValueValidatorChain(): ValidatorChainInterface
    {
        if(null !== $this->_tAppendValueValidatorChain){
            return $this->_tAppendValueValidatorChain;
        }

        $this->_tAppendValueValidatorChain = new ValidatorChain();

        $this->getBeforeAppend()->append(function($collection, $item, $key){
            $this->_tAppendValueValidatorChain->validate($item, $key, $collection);
        });

        return $this->_tAppendValueValidatorChain;
    }
    //</editor-fold>
}