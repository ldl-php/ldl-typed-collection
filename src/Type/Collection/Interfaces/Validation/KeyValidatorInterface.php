<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Validation;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Contracts\ToArrayInterface;
use LDL\Type\Collection\Interfaces\CollectionInterface;

interface KeyValidatorInterface extends ArrayFactoryInterface, ToArrayInterface
{
    /**
     * @param CollectionInterface $collection
     * @param mixed $item
     *
     * @param number|string $key
     * @return void
     *
     * @throws \Exception
     */
    public function validateKey(CollectionInterface $collection, $item, $key) : void;

}