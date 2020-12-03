<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Exception\TypeMismatchException;

class InterfaceComplianceItemValidator implements AppendItemValidatorInterface, ValidatorModeInterface, ValueValidatorInterface
{
    /**
     * @var string
     */
    private $interface;

    /**
     * @var bool
     */
    private $isStrict;

    public function __construct(string $interface, bool $strict=true)
    {
        if(!interface_exists($interface)){
            throw new \LogicException("$interface interface does not exists");
        }

        $this->isStrict = $strict;
        $this->interface = $interface;
    }

    public function isStrict(): bool
    {
        return $this->isStrict;
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(!is_object($item)){
            $msg = sprintf(
                'Validator "%s", only accepts objects as items being part of a collection',
                __CLASS__
            );
            throw new TypeMismatchException($msg);
        }

        if($item instanceof $this->interface) {
            return;
        }

        $msg = sprintf(
            'Item to be added of class "%s", does not complies to interface: "%s"',
            get_class($item),
            $this->interface
        );

        throw new TypeMismatchException($msg);
    }

}