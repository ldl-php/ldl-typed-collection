<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Contracts\LockableObjectInterface;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Types\Object\Filter\FilterByInterface;

interface ValidatorChainInterface extends CollectionInterface, LockableObjectInterface, FilterByInterface
{
    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     * @param number|string $key
     *
     * @throws \Exception
     *
     * @return void
     */
    public function validate(CollectionInterface $collection, $item, $key) : void;

    /**
     * @param array $config
     * @return ValidatorChainInterface
     */
    public static function fromConfig(array $config): ValidatorChainInterface;

    /**
     * @return array
     */
    public function getConfig(): array;
}