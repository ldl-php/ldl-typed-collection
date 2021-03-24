<?php declare(strict_types=1);
/**
 * There are two interfaces for validators, one which validates values and another which validates keys (this one)
 * at simple sight, one may think that just having ONE single interface with a validate method would be enough,
 * however there are a few problems with this approach, for example, what happens when you want to validate
 * that a collection has a key named "foo" and not a value "foo", in this case a validate method alone doesn't cut it
 * One of such examples is the Validation\UniqueValidator.
 *
 * In most scenarios if a validator implements dual validation (for keys and values) one can avoid code duplication
 * by calling the validateValue method inside the validateKey method with a simple parameter switch
 * (in layman's terms, passing the key as the item).
 *
 * One of such examples can be found in the Validator\RegexValidator.
 */
namespace LDL\Type\Collection\Interfaces\Validation;

use LDL\Type\Collection\TypedCollectionInterface;

interface KeyValidatorInterface
{
    /**
     * @param TypedCollectionInterface $collection
     * @param mixed $item
     *
     * @param number|string $key
     * @return void
     *
     * @throws \Exception
     */
    public function validateKey(TypedCollectionInterface $collection, $item, $key) : void;

}