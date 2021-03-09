<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\String\Validator\Config;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterfaceTrait;

class StringValidatorConfig implements ValidatorConfigInterface
{
    use ValidatorConfigInterfaceTrait;

    public function __construct(bool $strict=true)
    {
        $this->_isStrict = $strict;
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
     */
    public static function fromArray(array $data = []): ArrayFactoryInterface
    {
        return new self(array_key_exists('strict', $data) ? (bool)$data['strict'] : true);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'strict' => $this->_isStrict
        ];
    }
}