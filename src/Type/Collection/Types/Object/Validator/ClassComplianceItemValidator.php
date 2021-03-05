<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object\Validator;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Exception\ArrayFactoryException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Exception\TypeMismatchException;

class ClassComplianceItemValidator implements AppendItemValidatorInterface, ValidatorModeInterface, ValueValidatorInterface
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

    public function validateValue(CollectionInterface $collection, $item, $key): void
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

    public function jsonSerialize() : array
    {
        return $this->toArray();
    }

    public static function fromArray(array $data = []): ArrayFactoryInterface
    {
        if(false === array_key_exists('className', $data)){
            $msg = sprintf("Missing property 'className' in %s", __CLASS__);
            throw new ArrayFactoryException($msg);
        }

        try{
            return new self((string) $data['className'], array_key_exists('strict', $data) ? (bool)$data['strict'] : true);
        }catch(\Exception $e){
            throw new ArrayFactoryException($e->getMessage());
        }
    }

    public function toArray(): array
    {
        return [
            'class' => __CLASS__,
            'options' => [
                'className' => $this->class,
                'strict' => $this->isStrict
            ]
        ];
    }
}