<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Exception\ArrayFactoryException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\RemoveItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Helper\RegexValidatorHelper;

class RegexValidator implements AppendItemValidatorInterface, RemoveItemValidatorInterface, ValidatorModeInterface, KeyValidatorInterface, ValueValidatorInterface
{
    /**
     * @var bool
     */
    private $_isStrict;

    /**
     * @var string
     */
    private $regex;

    public function __construct(string $regex, bool $strict=false)
    {
        RegexValidatorHelper::validate($regex);

        $this->regex = $regex;
        $this->_isStrict = $strict;
    }

    public function isStrict() : bool
    {
        return $this->_isStrict;
    }

    public function validateKey(CollectionInterface $collection, $item, $key): void
    {
        $this->validateValue($collection, $key, $item);
    }

    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @throws Exception\RegexValidatorException
     *
     */
    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(preg_match($this->regex, (string) $item)) {
            return;
        }

        $msg = "Given value: \"$item\" does not matches regex: \"{$this->regex}\"";
        throw new Exception\RegexValidatorException($msg);
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return $this->toArray();
    }

    /**
     * @param array $data
     * @return ArrayFactoryInterface
     * @throws ArrayFactoryException
     */
    public static function fromArray(array $data = []): ArrayFactoryInterface
    {
        if(false === array_key_exists('regex', $data)){
            $msg = sprintf("Missing property 'regex' in %s", __CLASS__);
            throw new ArrayFactoryException($msg);
        }

        try{
            return new self((string) $data['regex'], array_key_exists('strict', $data) ? (bool)$data['strict'] : false);
        }catch(\Exception $e){
            throw new ArrayFactoryException($e->getMessage());
        }

    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'class' => __CLASS__,
            'options' => [
                'regex' => $this->regex,
                'strict' => $this->_isStrict
            ]
        ];
    }
}