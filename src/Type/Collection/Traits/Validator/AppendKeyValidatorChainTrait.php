<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Validator;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValidatorChainInterface;
use LDL\Type\Collection\Types\String\StringCollection;
use LDL\Validators\Chain\ValidatorChain;
use LDL\Validators\Chain\ValidatorChainInterface;

trait AppendKeyValidatorChainTrait
{
    /**
     * @var StringCollection
     */
    private $_tAppendKeyCollection;

    public function getAppendKeyValidatorChain(): ValidatorChainInterface
    {
        if(null !== $this->_tAppendKeyCollection){
            return $this->_tAppendKeyCollection->getAppendValidatorChain();
        }

        /**
         * Use an anonymous class here, a proper class is not needed
         */
        $this->_tAppendKeyCollection = new class extends AbstractCollection implements HasAppendValidatorChainInterface
        {
            use AppendValidatorChainTrait;

            /**
             * @var ValidatorChainInterface
             */
            private $validatorChain;

            public function __construct(iterable $items = null)
            {
                parent::__construct($items);

                $this->validatorChain = new ValidatorChain();

                $this->getBeforeAppend()->append(function($collection, $item, $key){
                    $this->validatorChain->validate($item, $key, $collection);
                });
            }

            public function getValidatorChain(): ValidatorChainInterface
            {
                return $this->validatorChain;
            }
        };

        $this->getBeforeAppend()->append(function($collection, $item, $key){
            $this->_tAppendKeyCollection->append($key);
        });

        return $this->_tAppendKeyCollection->getValidatorChain();
    }
}