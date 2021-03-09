<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator\Config;

trait ValidatorConfigInterfaceTrait
{
    /**
     * @var bool
     */
    private $_isStrict;

    public function isStrict() : bool
    {
        return $this->_isStrict;
    }
}