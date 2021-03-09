<?php declare(strict_types=1);

namespace LDL\Type\Collection\Traits\Validator;

use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;

trait ValidatorInterfaceTrait
{
    /**
     * @var ValidatorConfigInterface
     */
    private $_config;

    public function getConfig() : ValidatorConfigInterface
    {
        return $this->_config;
    }

}