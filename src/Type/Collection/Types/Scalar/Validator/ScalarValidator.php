<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Scalar\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Exception\TypeMismatchException;

class ScalarValidator implements AppendItemValidatorInterface, ValidatorModeInterface, ValueValidatorInterface, KeyValidatorInterface
{
    /**
     * @var bool
     */
    private $isStrict;

    /**
     * @var bool
     */
    private $acceptToStringObjects;

    public function __construct(
        bool $strict = false,
        bool $acceptToStringObjects=true
    )
    {
        $this->isStrict = $strict;
        $this->acceptToStringObjects = $acceptToStringObjects;
    }

    public function isStrict() : bool
    {
        return $this->isStrict;
    }

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->validateValue($collection, $key, $item);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(is_scalar($item)){
            return;
        }

        /**
         * Object with __toString method
         */
        if(
            $this->acceptToStringObjects &&
            is_object($item) &&
            in_array('__tostring', array_map('strtolower', get_class_methods($item)), true)
        ){
            return;
        }

        $msg = sprintf(
            'Value expected for "%s", must be scalar, "%s" was given',
            __CLASS__,
            gettype($item)
        );

        throw new TypeMismatchException($msg);
    }

}