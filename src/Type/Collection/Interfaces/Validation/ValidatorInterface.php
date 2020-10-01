<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Validation;

use LDL\Type\Collection\Interfaces\CollectionInterface;

interface ValidatorInterface
{
    /**
     * @param CollectionInterface $collection
     * @param number|string $key
     * @param mixed $item
     *
     * @return void
     *
     * @throws \Exception
     */
    public function validate(CollectionInterface $collection, $item, $key) : void;

}