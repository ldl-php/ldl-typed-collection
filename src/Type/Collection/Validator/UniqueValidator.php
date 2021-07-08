<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Type\Collection\Exception\CollectionValueException;
use LDL\Validators\NegatedValidatorInterface;
use LDL\Validators\Traits\NegatedValidatorTrait;
use LDL\Validators\Traits\ValidatorDescriptionTrait;
use LDL\Validators\Traits\ValidatorValidateTrait;
use LDL\Validators\ValidatorInterface;

class UniqueValidator implements ValidatorInterface, NegatedValidatorInterface
{
    use ValidatorValidateTrait;
    use NegatedValidatorTrait;
    use ValidatorDescriptionTrait;

    private const DESCRIPTION = 'Validate that the item within the collection is unique';

    public function __construct(bool $negated=false, string $description=null)
    {
        $this->_tNegated = $negated;
        $this->_tDescription = $description ?? self::DESCRIPTION;
    }

    public function assertTrue($value, $key = null, CollectionInterface $collection = null): void
    {
        if(!$collection->hasValue($value)){
            return;
        }

        throw new CollectionValueException(
            sprintf(
                'Item with value %s already exists in this collection!',
                var_export($value, true)
            )
        );
    }

    public function assertFalse($value, $key = null, CollectionInterface $collection = null): void
    {
        if($collection->hasValue($value)){
            return;
        }

        throw new CollectionValueException(
            sprintf(
                'Item with value %s NOT exists in this collection!',
                var_export($value, true)
            )
        );
    }
}
