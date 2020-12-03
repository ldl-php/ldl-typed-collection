<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\RemoveItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Helper\RegexValidatorHelper;

class RegexValidator implements AppendItemValidatorInterface, RemoveItemValidatorInterface, ValidatorModeInterface
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

    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     * @throws Exception\RegexValidatorException
     *
     */
    public function validate(CollectionInterface $collection, $item, $key): void
    {
        if(preg_match($this->regex, (string) $item)) {
            return;
        }

        $msg = "Given value: \"$item\" does not matches regex: \"{$this->regex}\"";
        throw new Exception\RegexValidatorException($msg);
    }
}