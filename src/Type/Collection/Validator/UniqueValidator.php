<?php declare(strict_types=1);

/**
 * To use this validator correctly when using a collection of objects make sure to apply ComparisonInterface
 * to each of the objects which is added to the collection.
 *
 * This will provide an easier and uncomplicated way to compare objects through a scalar value
 * rather than applying object comparison rules (https://www.php.net/manual/en/language.oop5.object-comparison.php)
 *
 * @see \LDL\Framework\Base\Collection\Contracts\ComparisonInterface
 */

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Framework\Base\Collection\Contracts\ComparisonInterface;
use LDL\Framework\Base\Constants;
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

    /**
     * @var callable
     */
    private $valueResolverCallback;

    public function __construct(
        bool $negated=false,
        string $description=null,
        callable $valueResolverCallback=null
    )
    {
        $this->_tNegated = $negated;
        $this->_tDescription = $description ?? self::DESCRIPTION;

        $compare = function ($value){
            if(is_object($value) && $value instanceof ComparisonInterface){
                $value = $value->getComparisonValue();
            }

            return $value;
        };

        $this->valueResolverCallback = $valueResolverCallback ?? $compare;
    }

    public function assertTrue($value, $key = null, CollectionInterface $collection = null): void
    {
        $callback = $this->valueResolverCallback;

        $value = $callback($value, $this, $key, $collection);

        if(!$collection->hasValue($value, Constants::OPERATOR_SEQ, Constants::COMPARE_LTR)){
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
        $callback = $this->valueResolverCallback;

        $value = $callback($value, $this, $key, $collection);

        if($collection->hasValue($value, Constants::OPERATOR_SEQ, Constants::COMPARE_LTR)){
            return;
        }

        throw new CollectionValueException(
            sprintf(
                'Item with value %s does NOT exists in this collection!',
                var_export($value, true)
            )
        );
    }
}
