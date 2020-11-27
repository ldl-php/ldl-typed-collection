<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Types\Object\Filter\FilterByInterface;
use LDL\Type\Collection\Interfaces\Filter\FilterByClassInterface;

interface ObjectCollectionInterface extends CollectionInterface, FilterByInterface, FilterByClassInterface
{

}