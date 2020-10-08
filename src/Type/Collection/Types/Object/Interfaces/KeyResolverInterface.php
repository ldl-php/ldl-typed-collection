<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object\Interfaces;

interface KeyResolverInterface
{
    public function getItemKey() : string;
}