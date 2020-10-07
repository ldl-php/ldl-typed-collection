<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Validator;

trait ValidatorModeTrait
{
    /**
     * @var bool
     */
    private $_isStrict;

    public function __construct(bool $strict=true)
    {
        $this->_isStrict = $strict;
    }

    public function isStrict() : bool
    {
        return $this->_isStrict;
    }
}