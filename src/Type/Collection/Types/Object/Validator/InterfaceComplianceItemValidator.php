<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object\Validator;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Exception\ArrayFactoryException;
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

    public function jsonSerialize() : array
    {
        return $this->toArray();
    }

    public static function fromArray(array $data = []): ArrayFactoryInterface
    {
        if(false === array_key_exists('interfaceName', $data)){
            $msg = sprintf("Missing property 'interfaceName' in %s", __CLASS__);
            throw new ArrayFactoryException($msg);
        }

        try{
            return new self((string) $data['interfaceName'], array_key_exists('strict', $data) ? (bool)$data['strict'] : true);
        }catch(\Exception $e){
            throw new ArrayFactoryException($e->getMessage());
        }
    }

    public function toArray(): array
    {
        return [
            'class' => __CLASS__,
            'options' => [
                'interfaceName' => $this->interface,
                'strict' => $this->isStrict
            ]
        ];
    }
}