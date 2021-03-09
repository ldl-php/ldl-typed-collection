<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Validation;

use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;

interface ValidatorInterface
{
    /**
     * @return ValidatorConfigInterface
     */
    public function getConfig();

    /**
     * @param ValidatorConfigInterface $config
     * @return ValidatorInterface
     */
    public static function fromConfig(ValidatorConfigInterface $config) : ValidatorInterface;
}