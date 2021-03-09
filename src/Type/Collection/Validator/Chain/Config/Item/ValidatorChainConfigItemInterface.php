<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator\Chain\Config\Item;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Contracts\ToArrayInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;

interface ValidatorChainConfigItemInterface extends ArrayFactoryInterface, ToArrayInterface, \JsonSerializable
{
    /**
     * @return int|string|double
     */
    public function getKey();
    /**
     * @return string
     */
    public function getClass(): string;

    /**
     * @return ValidatorConfigInterface
     */
    public function getConfig(): ValidatorConfigInterface;

    /**
     * @return ValidatorInterface
     */
    public function getValidatorInstance() : ValidatorInterface;
}