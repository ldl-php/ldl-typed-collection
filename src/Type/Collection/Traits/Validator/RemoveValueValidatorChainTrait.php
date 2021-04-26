<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Validator;

use LDL\Validators\Chain\AndValidatorChain;
use LDL\Validators\Chain\ValidatorChainInterface;

trait RemoveValueValidatorChainTrait
{
    /**
     * @var ValidatorChainInterface
     */
    private $_tRemoveValidatorChain;

    //<editor-fold desc="HasRemoveValueValidatorChainInterface methods">
    public function getRemoveValueValidatorChain(string $class=null, iterable $items=null): ValidatorChainInterface
    {
        if(null !== $this->_tRemoveValidatorChain){
            return $this->_tRemoveValidatorChain;
        }

        if(null === $class){
            $class=AndValidatorChain::class;
        }

        if(!class_exists($class)){
            throw new \InvalidArgumentException("Invalid class \"$class\"");
        }

        if(!is_subclass_of($class, ValidatorChainInterface::class)){
            throw new \InvalidArgumentException(
                sprintf(
                    'Given class must be an instance of "%s"; "%s" was given',
                    ValidatorChainInterface::class,
                    $class
                )
            );
        }

        $this->_tRemoveValidatorChain = new $class;

        $this->getBeforeRemove()->append(function($collection, $item, $key){
            $this->_tRemoveValidatorChain->validate($item, $key, $collection);
        });

        return $this->_tRemoveValidatorChain;
    }
    //</editor-fold>
}