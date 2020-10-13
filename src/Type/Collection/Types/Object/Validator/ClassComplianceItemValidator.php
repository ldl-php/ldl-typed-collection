<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Exception\TypeMismatchException;

class ClassComplianceItemValidator implements AppendItemValidatorInterface, ValidatorModeInterface
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var bool
     */
    private $isStrict;

    public function __construct(string $class, bool $strict=true)
    {
        if(!class_exists($class)){
            throw new \LogicException("Class \"$class\" does not exists");
        }

        $this->isStrict = $strict;
        $this->class = $class;
    }

    public function isStrict(): bool
    {
        return $this->isStrict;
    }

    public function validate(CollectionInterface $collection, $item, $key): void
    {
        if(!is_object($item)){
            $msg = sprintf(
                'Validator "%s", only accepts objects as items being part of a collection',
                __CLASS__
            );
            throw new TypeMismatchException($msg);
        }

        if($item instanceof $this->class) {
            return;
        }

        $msg = sprintf(
            'Item to be added of class "%s", is not an instanceof class: "%s"',
            get_class($item),
            $this->class
        );

        throw new TypeMismatchException($msg);
    }

}