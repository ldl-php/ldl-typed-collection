<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Lockable\Validator\Config;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterfaceTrait;

class LockingValidatorConfig implements ValidatorConfigInterface
{
    use ValidatorConfigInterfaceTrait;

    public function __construct()
    {
        $this->_isStrict = true;
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
        return new self();
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