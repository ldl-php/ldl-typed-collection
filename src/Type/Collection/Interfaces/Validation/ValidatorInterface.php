<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Validation;

use LDL\Type\Collection\Interfaces\CollectionInterface;

interface ValidatorInterface
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
    public function validate(CollectionInterface $collection, $item, $key) : void;

}