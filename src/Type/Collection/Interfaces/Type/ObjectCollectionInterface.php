<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Type;

use LDL\Type\Collection\TypedCollectionInterface;
use LDL\Framework\Base\Collection\Contracts\FilterByInterface;
use LDL\Framework\Base\Collection\Contracts\FilterByClassInterface;
use LDL\Framework\Base\Collection\Contracts\FilterByMethodInterface;

interface ObjectCollectionInterface extends TypedCollectionInterface, FilterByInterface, FilterByClassInterface, FilterByMethodInterface
{

}