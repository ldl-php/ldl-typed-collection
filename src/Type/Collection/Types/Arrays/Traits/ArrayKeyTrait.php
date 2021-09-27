<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Arrays\Traits;

use LDL\Framework\Base\Contracts\Type\ToArrayKeyInterface;
use LDL\Framework\Base\Contracts\Type\ToIntegerInterface;
use LDL\Framework\Base\Contracts\Type\ToStringInterface;
use LDL\Framework\Helper\IterableHelper;
use LDL\Type\Collection\Types\Arrays\ArrayKeyCollection;
use LDL\Type\Collection\Types\Arrays\UniqueArrayKeyCollection;

trait ArrayKeyTrait
{
    /**
     * @var bool
     */
    protected $_tArrayKeyTraitIsTraversable;

    /**
     * @param bool $preserveKeys
     * @return array
     */
    public function toPrimitiveArray(bool $preserveKeys): array
    {
        if(!$this->_tArrayKeyTraitIsTraversable && !$this instanceof \Traversable){
            throw new \LogicException(
                sprintf(
                    'Object which uses trait %s is not traversable',
                    ArrayKeyTrait::class
                )
            );
        }

        $this->_tArrayKeyTraitIsTraversable = true;

        return IterableHelper::map(
            $this,
            /**
             * @param ToArrayKeyInterface $val
             * @return mixed
             */
            static function($val){
                if(is_int($val) || is_string($val)){
                    return $val;
                }

                if($val instanceof ToArrayKeyInterface){
                    return $val->toArrayKey();
                }

                $isInteger = $val instanceof ToIntegerInterface;
                $isString = $val instanceof ToStringInterface;

                if(!$isInteger && !$isString){
                    throw new \LogicException(
                        sprintf(
                        'Given value is not an instance of %s || %s || %s, are you using this trait correctly?',
                        ToIntegerInterface::class,
                        ToStringInterface::class,
                            ToArrayKeyInterface::class
                        )
                    );
                }

                /**
                 * In this case, if the class implements both interfaces, the value to be resolved
                 * as primitive would be ambiguous so we throw an exception.
                 */
                if($isInteger && $isString){
                    $msg = sprintf(
                        'Could not convert object of class "%s" to primitive array. Object implements two interfaces, ("%s" and "%s"). To resolve this ambiguity, remove one of the interfaces or implement interface "%s"',
                        get_class($val),
                        ToIntegerInterface::class,
                        ToStringInterface::class,
                        ToArrayKeyInterface::class
                    );

                    throw new \LogicException($msg);
                }

                if($isInteger){
                    return $val->toInteger();
                }

                return $val->toString();
            },  $preserveKeys);
    }
}