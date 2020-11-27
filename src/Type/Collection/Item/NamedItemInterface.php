<?php declare(strict_types=1);

namespace LDL\Type\Collection\Item;

interface NamedItemInterface
{
    public function getName();

    public function getValue();
}