<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Scalar\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Exception\TypeMismatchException;

class ScalarValidator implements AppendItemValidatorInterface, ValidatorModeInterface
{
    /**
     * @var bool
     */
    private $isStrict;

    /**
     * @var bool
     */
    private $acceptToStringObjects;

    /**
     * @var string
     */
    private $validate;

    public function __construct(
        bool $strict = false,
        bool $acceptToStringObjects=true,
        string $validate='item'
    )
    {
        $this->isStrict = $strict;
        $this->acceptToStringObjects = $acceptToStringObjects;
        $this->validate = $validate;
    }

    public function isStrict() : bool
    {
        return $this->isStrict;
    }

    public function validate(CollectionInterface $collection, $item, $key): void
    {
        switch($this->validate){
            case 'key':
                $value = $key;
                break;
            case 'item':
                $value = $item;
                break;
            default:
                throw new \LogicException("Invalid validate option \"{$this->validate}\". Validate option must be one of: [key, item]");
        }

        if(is_scalar($value)){
            return;
        }

        /**
         * Object with __toString method
         */
        if(
            $this->acceptToStringObjects &&
            is_object($key) &&
            in_array('__tostring', array_map('strtolower', get_class_methods($key)), true)
        ){
            return;
        }

        $msg = sprintf(
            'Value expected for "%s", must be scalar, "%s" was given',
            __CLASS__,
            gettype($value)
        );

        throw new TypeMismatchException($msg);
    }

}