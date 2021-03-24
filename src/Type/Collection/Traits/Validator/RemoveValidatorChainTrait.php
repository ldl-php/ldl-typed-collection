<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Validator;

use LDL\Validators\Chain\ValidatorChain;
use LDL\Validators\Chain\ValidatorChainInterface;

trait RemoveValidatorChainTrait
{
    /**
     * @var ValidatorChainInterface
     */
    private $_tRemoveValidatorChain;

    public function getRemoveValidatorChain(): ValidatorChainInterface
    {
        if(null !== $this->_tRemoveValidatorChain){
            return $this->_tRemoveValidatorChain;
        }

        $this->_tRemoveValidatorChain = new ValidatorChain();

        $this->getBeforeRemove()->append(function($collection, $item, $key){
            $this->_tRemoveValidatorChain->validate($item, $key, $collection);
        });

        return $this->_tRemoveValidatorChain;
    }
}