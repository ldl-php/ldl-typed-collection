<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Framework\Helper\ArrayHelper\ArrayHelper;
use LDL\Framework\Helper\ClassHelper;
use LDL\Type\Collection\Exception\CollectionValueException;
use LDL\Type\Collection\Helper\UniqueTypeHelper;
use LDL\Type\Collection\Validator\Exception\DuplicateValueException;
use LDL\Validators\NegatedValidatorInterface;
use LDL\Validators\Traits\NegatedValidatorTrait;
use LDL\Validators\Traits\ValidatorDescriptionTrait;
use LDL\Validators\Traits\ValidatorValidateTrait;
use LDL\Validators\ValidatorHasConfigInterface;
use LDL\Validators\ValidatorInterface;

class UniqueTypeValidator implements ValidatorInterface, NegatedValidatorInterface, ValidatorHasConfigInterface
{
    use ValidatorValidateTrait;
    use NegatedValidatorTrait;
    use ValidatorDescriptionTrait;

    private const DESCRIPTION = 'Validate that the item within the collection is unique';

    /**
     * @var string
     */
    private $typeMethod;

    /**
     * @var array|null
     */
    private $typeMethodArgs;

    public function __construct(
        string $typeMethod,
        array $typeMethodArguments=null,
        bool $negated=false,
        string $description=null
    )
    {
        $this->typeMethod = $typeMethod;
        $this->typeMethodArgs = $typeMethodArguments;
        $this->_tNegated = $negated;
        $this->_tDescription = $description ?? self::DESCRIPTION;
    }

    public function assertTrue($value, $key = null, CollectionInterface $collection = null): void
    {
        if(!UniqueTypeHelper::hasValue($value, $this->typeMethod, $collection)){
            return;
        }

        $method = $this->typeMethod;

        throw new DuplicateValueException(
            sprintf(
                'Item with value %s already exists in this collection!',
                is_object($value) ? $value->$method() : $value
            )
        );
    }

    public function assertFalse($value, $key = null, CollectionInterface $collection = null): void
    {
        if(UniqueTypeHelper::hasValue($value, $this->typeMethod, $collection)){
            return;
        }

        throw new CollectionValueException(
            sprintf(
                'Item with value %s does NOT exists in this collection!',
                var_export($value, true)
            )
        );
    }

    /**
     * @param array $data
     * @return ValidatorInterface
     * @throws Exception\InvalidConfigException
     */
    public static function fromConfig(array $data = []): ValidatorInterface
    {
        if(!array_key_exists('method', $data)){
            $msg = sprintf("Missing property 'method' in %s", __CLASS__);
            throw new Exception\InvalidConfigException($msg);
        }

        try{
            return new self(
                $data['method'],
                array_key_exists('arguments', $data) ? $data['arguments'] : null,
                array_key_exists('negated', $data) ? (bool) $data['negated'] : null,
                array_key_exists('description', $data) ? (bool) $data['description'] : null,
            );
        }catch(\Exception $e){
            throw new Exception\InvalidConfigException($e->getMessage());
        }
    }

    public function jsonSerialize(): array
    {
        return $this->getConfig();
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return [
            'method' => $this->typeMethod,
            'arguments' => $this->typeMethodArgs,
            'negated' => $this->_tNegated,
            'description' => $this->_tDescription
        ];
    }

    //<editor-fold desc="Private methods">
    private function hasValue($value, CollectionInterface $collection) : bool
    {
        $method = $this->typeMethod;
        $values = [];

        if(is_object($value) && !ClassHelper::hasMethod(get_class($value), $this->typeMethod)){
            throw new \InvalidArgumentException(sprintf(
                'Object of class %s does not has a method named %s',
                get_class($value),
                $this->typeMethod
            ));
        }

        $value = is_object($value) ? $value->$method() : $value;

        foreach($collection as $item){
            if(is_object($value) && !ClassHelper::hasMethod(get_class($value), $this->typeMethod)){
                throw new \InvalidArgumentException(sprintf(
                    'Object of class %s does not has a method named %s',
                    get_class($value),
                    $this->typeMethod
                ));
            }

            $values[] = is_object($item) ? $item->$method() : $item;
        }

        return (bool) ArrayHelper::hasValue($values,$value);
    }
    //</editor-fold>

}
